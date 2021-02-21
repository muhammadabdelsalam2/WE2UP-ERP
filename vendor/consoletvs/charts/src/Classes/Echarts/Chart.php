<?php

namespace ConsoleTVs\Charts\Classes\Echarts;

use ConsoleTVs\Charts\Classes\BaseChart;
use ConsoleTVs\Charts\Features\Echarts\Chart as ChartFeatures;

class Chart extends BaseChart
{
    use ChartFeatures;

    /**
     * Chartjs dataset class.
     *
     * @var object
     */
    public $dataset = Dataset::class;

    /**
     * Store the theme for the chart.
     *
     * @var string
     */
    public $theme = 'default';

    /**
     * Initiates the Chartjs Line Chart.
     *options3d: {
            enabled: true,
            alpha: 10,
            beta: 25,
            depth: 70
        }
     * @return self
     */
    public function __construct()
    {
        parent::__construct();

        $this->container = 'charts::echarts.container';
        $this->script = 'charts::echarts.script';

        return $this->options([
            'legend' => [
                'show' => true,
            ],
            'options3d' => [
                'show'=> true,
                'alpha'=> 10,
                'beta'=> 25,
                'depth'=> 70
            ],
            'plotOptions'=> [
               'column'=> [
                  'depth'=> 50
                ]
            ],
            'tooltip' => [
                'show' => true,
            ],
            'xAxis' => [
                'show' => true,
            ],
            'yAxis' => [
                'show' => true,
            ],
        ]);
    }

    /**
     * Formats the options.
     *
     * @return self
     */
    public function formatOptions(bool $strict = false, bool $noBraces = false)
    {
        $this->options([
            'xAxis' => [
                'data' => json_decode($this->formatLabels()),
            ],
            'options3d' => [
                'show'=> true,
                'alpha'=> 10,
                'beta'=> 25,
                'depth'=> 70
            ],
            'plotOptions'=> [
               'column'=> [
                  'depth'=> 50
                ]
            ],
        ]);

        return parent::formatOptions($strict, $noBraces);
    }
}
