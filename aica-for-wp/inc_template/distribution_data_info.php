<?php
$html = '<div class="div_non_summary_table" >';
$html .= '<table class="table table-sm table-striped">';
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th colspan="7" >Distribution Data</th>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<th>Ticker</th>';
$html .= '<th>Indicated Yield</th>';
$html .= '<th>Trailing Yield</th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';
foreach($get_fund_info As $info) {
$html .= '<tr>';
$html .= '<td>' . $info['ticker'] . '</td>';
$html .= '<td>' . $info['nav_yield'] . '</td>';
$html .= '<td>' . $info['trailing_yield'] . '</td>';
$html .= '</tr>';
}
$html .= '</tbody>';
$html .= '</table>';
$html .= '</div>';
?>