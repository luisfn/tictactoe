<table>

    @foreach ($board as $line)

        <tr>

        @foreach ($line as $cell)

            <td>@if ($cell) {{ $cell->getSymbol() }}@endif </td>

        @endforeach

        </tr>

    @endforeach

</table>