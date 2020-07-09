<?php

	// Start listed funds criteria box
	$html .= '<div class="div_criteria_form container">';
	$html .= '<div class="">';
	$html .= '<div class="card-body">';		
	$html .= '<h4>Criteria</h4>';
	$html .= '<form>';
	$html .= '<div class="row mb-3">';	
	$html .= '<div class="col-md-4" >';
	$html .= '<div class="row " ><div class="col-md-12" >';
	$html .= '<div class=" mb-3 mr-3" ><b>CEF Sponsors</b><br /><select multiple name="txt_sponser" class="txt_sponsor d-none" >' . $sponsors_options . '</select></div>';
	$html .= '</div></div>';
	
	$html .= '<div class="row" >';
	$html .= '<div class="col-md-12" >';
	$html .= '<div class=" mb-3" ><b>Main Group</b><br /><select multiple name="txt_main_group" class="txt_main_group d-none" >' . $maingroups_options . '</select></div>';	
	$html .= '</div></div>';	

	$html .= '<div class="row " ><div class="col-md-12" ><b>Dividend Frequency:</b></div><div class="input-group col-md-12" ><select name="sel_div_freq" id="sel_div_freq" multiple class="sel_div_freq d-none" ></select></div></div>';	
	
	$html .= '</div>';	
	
	$html .= '<div class="col-md-4" >';
	$html .= '<div class="row " ><div class="col-md-12" >';
	$html .= '<div class=" mb-3 mr-3" ><b>BDC Sponsors</b><br /><select multiple name="txt_sponser_b" class="txt_sponsor_b d-none" >' . $sponsors_bdc_options . '</select></div>';
	$html .= '</div></div>';	
	
	$html .= '<div class="row" >';
	$html .= '<div class="col-md-12" >';
	$html .= '<div class=" mb-3 mr-3" ><b>Peer Group</b><br /><select multiple name="txt_peer_group" class="txt_peer_group d-none" >' . $peergroups_options . '</select></div>';	
	$html .= '</div></div>';	
	
	$html .= '</div>';
	
	$html .= '<div class="col-md-4 div-inception-date" >';
	$html .= '<div class="row mb-3" ><div class="col-md-12" ><b>Inception Date:</b></div><div class="input-group date col-md-6" id="datetimepicker1"><input type="text" ng-model="inception_min" class="form-control" value="01/01/2019" /><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span></div><div class="input-group date col-md-6" id="datetimepicker2"><input type="text" ng-model="inception_max" class="form-control" value="01/12/2019" /><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span></div></div>';	
	
	$html .= '<div class="row mb-3"><div class="col-md-12" >';
	$html .= '<b>CEF Data Total Return Rankings</b><br />';
	$html .= '<select id="sel_cefa_rank" name="sel_cefa_rank" class="d-none" >';
	$html .= '<option value="" >None</option>';
	$html .= '</select>';
	$html .= '</div>';
	$html .= '</div>';
	
	$html .= '<div class="row" >';
	$html .= '<div class="col-md-12 mt-2" >';
	$html .= '<b>Fund Universe Listed</b><br />';
	$html .= '<div class="radio radio-inline col-md-12 mt-2" ng-repeat="fundtype in typearr" ><input name="inp_fundtype" id="inp_fundtype" type="radio" ng-model="options[$index]" ng-value="fundtype" ng-change="togDivfreq($index)" data-val="{{fundtype.value}}" value="{{fundtype.name}}" ><label class="ml-2" for="chk-{{fundtype.id}}">{{fundtype.name}}</label></div>';
	$html .= '</div>';	
	$html .= '</div>';	

	$html .= '</div>';
	$html .= '</div>';	
	
	$html .= '<div class="row"><div class="col-md-12 mb-4" ><a data-toggle="collapse" href="#70291516059420">[Advanced Search]</a></div></div>';

	$html .= '<div id="70291516059420" class="panel-collapse collapse in">';	
	
	$html .= '<div class="row mb-4">';	
	$html .= '<div class="col-sm-6" >';	
	$html .= '<div class="mb-3" ><rzslider rz-slider-model="slider.minValue" rz-slider-high="slider.maxValue" rz-slider-options="slider.options"></rzslider></div>';
	$html .= '<div class="mb-3" ><rzslider rz-slider-model="mk_yield.minValue" rz-slider-high="mk_yield.maxValue" rz-slider-options="mk_yield.options"></rzslider></div>';	
	$html .= '<div class="mb-3" ><rzslider rz-slider-model="tr_price_ytd.minValue" rz-slider-high="tr_price_ytd.maxValue" rz-slider-options="tr_price_ytd.options"></rzslider></div>';	
	$html .= '<div class="mb-3" ><rzslider rz-slider-model="tr_nav_ytd.minValue" rz-slider-high="tr_nav_ytd.maxValue" rz-slider-options="tr_nav_ytd.options"></rzslider></div>';
	$html .= '<div class="mb-3" ><rzslider rz-slider-model="tr_price_1yr.minValue" rz-slider-high="tr_price_1yr.maxValue" rz-slider-options="tr_price_1yr.options"></rzslider></div>';
	$html .= '<div class="mb-3" ><rzslider rz-slider-model="tr_nav_1yr.minValue" rz-slider-high="tr_nav_1yr.maxValue" rz-slider-options="tr_nav_1yr.options"></rzslider></div>';
	$html .= '<div class="mb-3" ><rzslider rz-slider-model="nav.minValue" rz-slider-high="nav.maxValue" rz-slider-options="nav.options"></rzslider></div>';		
	$html .= '<div class="mb-3" ><rzslider rz-slider-model="beta_12.minValue" rz-slider-high="beta_12.maxValue" rz-slider-options="beta_12.options"></rzslider></div>';	
	$html .= '</div>';
	
	$html .= '<div class="col-sm-6" >';
	$html .= '<div class="mb-3" ><rzslider rz-slider-model="tr_nav_3yr.minValue" rz-slider-high="tr_nav_3yr.maxValue" rz-slider-options="tr_nav_3yr.options"></rzslider></div>';
	$html .= '<div class="mb-3" ><rzslider rz-slider-model="tr_nav_5yr.minValue" rz-slider-high="tr_nav_5yr.maxValue" rz-slider-options="tr_nav_5yr.options"></rzslider></div>';	
	$html .= '<div class="mb-3" ><rzslider rz-slider-model="non_lev_exp_ratio.minValue" rz-slider-high="non_lev_exp_ratio.maxValue" rz-slider-options="non_lev_exp_ratio.options"></rzslider></div>';		
	$html .= '<div class="mb-3" ><rzslider rz-slider-model="leverage.minValue" rz-slider-high="leverage.maxValue" rz-slider-options="leverage.options"></rzslider></div>';	
	$html .= '<div class="mb-3" ><rzslider rz-slider-model="net_assets_m.minValue" rz-slider-high="net_assets_m.maxValue" rz-slider-options="net_assets_m.options"></rzslider></div>';
	$html .= '<div class="mb-3" ><rzslider rz-slider-model="liq_90.minValue" rz-slider-high="liq_90.maxValue" rz-slider-options="liq_90.options"></rzslider></div>';
	$html .= '<div class="mb-3" ><rzslider rz-slider-model="price.minValue" rz-slider-high="price.maxValue" rz-slider-options="price.options"></rzslider></div>';
	$html .= '<div class="mb-3" ><rzslider rz-slider-model="corr_12.minValue" rz-slider-high="corr_12.maxValue" rz-slider-options="corr_12.options"></rzslider></div>';	
	$html .= '</div>';	
	$html .= '</div>';
	
	$html .= '</div>';
	
	$html .= '<div class="row" ><div class="col-md-12" ><button type="button" class="butt_submit btn btn-primary " ng-click="aicaSearch()" id="load" data-loading-text="<i class=\'fa fa-circle-o-notch fa-spin\'></i> LOADING ..." >SEARCH</button>&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" name="butt_reset" class="butt_reset btn btn-secondary" value="RESET ALL" ng-click="aicaReset()" >RESET ALL </button></div></div>';	
	
	$html .= '<input type="hidden" id="hid_user_id" name="hid_user_id" value="' . $user_id .'" ng-model="hid_user_id" />';

	$html .= '<input type="hidden" name="g-recaptcha-response" id="hid_cap_token" value="" />';
	
	$html .= '</form>';
	$html .= '</div>';
	$html .= '</div>';
	$html .= '</div>';
	// End listed funds criteria box	

?>