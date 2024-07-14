<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
    <g>
        <circle
            cx="50"
            cy="50"
            r="45"
            stroke="{{ $textColor }}"
            stroke-width="5"
            fill="{{ $bgColor }}"
        ></circle>
        <text
            x="50"
            y="50"
            fill="{{ $textColor }}"
            font-size="{{ $fontSize }}"
            text-anchor="middle"
            dominant-baseline="middle"
            font-family="Verdana"
            dy=".10em"
        >{{$initials}}</text>
    </g>
</svg>
