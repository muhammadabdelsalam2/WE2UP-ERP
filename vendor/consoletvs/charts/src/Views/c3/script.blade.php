<script {!! $chart->displayScriptAttributes() !!}>
    function {{ $chart->id }}_create(data) {
        {{ $chart->id }}_rendered = true;
        document.getElementById("{{ $chart->id }}_loader").style.display = 'none';
        document.getElementById("{{ $chart->id }}").style.display = 'block';
        window.{{ $chart->id }} = c3.generate({
            bindto: '#{{ $chart->id }}',
            data: data,
            options3d: {
                enabled: true,
                alpha: 10,
                beta: 25,
                depth: 70
            },
            plotOptions: {
                column: {
                  depth: 50
                },     
            {!! $chart->formatOptions(false, true) !!}
        });
    }
    @if ($chart->api_url)
    let {{ $chart->id }}_refresh = function (url) {
        document.getElementById("{{ $chart->id }}").style.display = 'none';
        document.getElementById("{{ $chart->id }}_loader").style.display = 'flex';
        if (typeof url !== 'undefined') {
            {{ $chart->id }}_api_url = url;
        }
        fetch({{ $chart->id }}_api_url)
            .then(data => data.json())
            .then(data => {
                {{ $chart->id }}.load(data);
                document.getElementById("{{ $chart->id }}_loader").style.display = 'none';
                document.getElementById("{{ $chart->id }}").style.display = 'block';
            });
    };
    @endif
    @include('charts::init')
</script>
