<?php
$html = '';
$html .= '<table class="table table-sm table-striped">';
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th colspan="2" >3 Year Distribution Level($): ' . (!empty($get_fund_info[0]['ticker']) ? $get_fund_info[0]['ticker'] : '') . '</th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';
$html .= '</tbody>';
$html .= '</table>';
$html .= '<div ng-controller="BarCtrl" ><canvas id="bar" class="chart chart-bar"
  chart-data="data" chart-labels="labels"> chart-series="series"
</canvas></div>';
?>