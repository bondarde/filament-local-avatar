<?php

namespace BondarDe\FilamentLocalAvatar;

use BondarDe\Colors\Color;
use BondarDe\FilamentLocalAvatar\Exceptions\MissingFontSizeException;
use Filament\AvatarProviders\Contracts\AvatarProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class LocalAvatarProvider implements AvatarProvider
{
    /**
     * @throws MissingFontSizeException
     */
    public function get(Model $record): string
    {
        $name = collect(config('filament-local-avatar.name_properties'))
            ->map(fn (string $property) => $record->$property)
            ->filter()
            ->first()
        ?? config('filament-local-avatar.fallback_name');

        return self::make($name);
    }

    /**
     * @throws MissingFontSizeException
     */
    public static function make(string $name): string
    {
        $initials = self::toInitials($name);
        $fontSize = self::toFontSize($initials);
        [
            $textColor,
            $bgColor,
        ] = self::toColors($initials);

        $html = view(FilamentLocalAvatarServiceProvider::$viewNamespace . '::svg', compact(
            'textColor',
            'bgColor',
            'fontSize',
            'initials',
        ))->toHtml();

        return 'data:image/svg+xml;base64,' . base64_encode($html);
    }

    public static function toInitials(string $name): string
    {
        $nameParts = [$name];
        $separators = config('filament-local-avatar.separators');
        $length = config('filament-local-avatar.length');

        foreach ($separators as $separator) {
            $nameParts = array_filter(
                self::splitParts($nameParts, $separator),
            );
        }

        return collect($nameParts)
            ->map(fn (string $segment): string => mb_substr($segment, 0, 1))
            ->map('strtoupper')
            ->slice(0, $length)
            ->join('');
    }

    private static function splitParts(array $parts, string $separator): array
    {
        return Arr::flatten(
            array_map(
                fn (string $part) => explode($separator, $part),
                $parts,
            ),
        );
    }

    /**
     * @throws MissingFontSizeException
     */
    private static function toFontSize(string $initials): string
    {
        $fontSizes = config('filament-local-avatar.font_sizes');
        $length = mb_strlen($initials);

        return $fontSizes[$length] ?? throw MissingFontSizeException::forLength($length);
    }

    private static function toColors(string $initials): array
    {
        $hex = substr(md5($initials), 0, 6);
        $color = Color::fromHex($hex);

        $textColor = $color->l(30);
        $bgColor = $color->l(80);

        return [
            $textColor->hex,
            $bgColor->hex,
        ];
    }
}
