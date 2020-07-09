<?php
$html = '';
$html .= '<table class="table table-sm table-striped">';
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th colspan="2" >Growth of $10,000:  ' . (!empty($get_fund_info[0]['ticker']) ? $get_fund_info[0]['ticker'] : '') . '</th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';
$html .= '</tbody>';
$html .= '</table>';
$html .= '<div ng-controller="LineCtrl" ><canvas id="line" class="chart chart-line" chart-data="data"
chart-labels="labels" chart-series="series" chart-options="options"
chart-dataset-override="datasetOverride" chart-click="onClick">
</canvas></div>';
?>