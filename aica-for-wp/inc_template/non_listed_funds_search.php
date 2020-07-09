<?php

	// Start non listed funds criteria box
	$html .= '<div class="div_criteria_form container">';
	$html .= '<div class="">';
	$html .= '<div class="card-body">';		
	$html .= '<h4>Criteria</h4>';
	$html .= '<form>';
	$html .= '<div class="row mb-3">';	
	$html .= '<div class="col-md-4" >';
	$html .= '<div class="row " ><div class="col-md-12" >';
	$html .= '<div class=" mb-3 mr-3" ><b>Sponsors</b><br /><select multiple name="txt_sponser" class="txt_sponsor d-none" >' . $sponsors_nl_options . '</select></div>';
	$html .= '</div></div>';
	
	$html .= '<div class="row" >';
	$html .= '<div class="col-md-12" >';
	$html .= '<div class=" mb-3" ><b>Major Group</b><br /><select multiple name="txt_major_group" class="txt_major_group d-none" >' . $majorgroups_options . '</select></div>';	
	$html .= '</div></div>';	

	$html .= '<div class="row " ><div class="col-md-12" ><b>Dividend Frequency:</b></div><div class="input-group col-md-12" ><select name="sel_non_div_freq" id="sel_non_div_freq" multiple class="sel_non_div_freq d-none" ></select></div></div>';	
	
	$html .= '</div>';	
	
	$html .= '<div class="col-md-4" >';
	$html .= '<div class="row " ><div class="col-md-12" >';
	$html .= '<div class=" mb-3 mr-3" ><b>Structure</b><br /><select multiple name="txt_type" class="txt_type d-none" >' . $type_options . '</select></div>';
	$html .= '</div></div>';	
	
	$html .= '<div class="row" >';
	$html .= '<div class="col-md-12" >';
	$html .= '<div class=" mb-3 mr-3" ><b>Sub Group</b><br /><select multiple name="txt_sub_group" class="txt_sub_group d-none" >' . $subgroups_options . '</select></div>';	
	$html .= '</div></div>';	
	
	$html .= '</div>';
	
	$html .= '<div class="col-md-4 div-inception-date" >';
	$html .= '<div class="row mb-3" ><div class="col-md-12" ><b>Inception Date:</b></div><div class="input-group date col-md-6" id="datetimepicker3"><input type="text" ng-model="inception_min" class="form-control" value="01/01/2019" /><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span></div><div class="input-group date col-md-6" id="datetimepicker4"><input type="text" ng-model="inception_max" class="form-control" value="01/12/2019" /><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span></div></div>';	
	
	$html .= '<div class="row mb-3"><div class="col-md-12" >';
	//$html .= '<b>CEF Data Total Return Rankings</b><br />';
	//$html .= '<select id="sel_cefa_rank" name="sel_cefa_rank" class="d-none" >';
	//$html .= '<option value="" >None</option>';
	//$html .= '</select>';
	$html .= '</div>';
	$html .= '</div>';
	
	$html .= '<div class="row" >';
	$html .= '<div class="col-md-12 mt-2" >';
	//$html .= '<b>Fund Universe Listed</b><br />';
	//$html .= '<div class="radio radio-inline col-md-12 mt-2" ng-repeat="fundtype in typearr" ><input name="inp_fundtype" id="inp_fundtype" type="radio" ng-model="options[$index]" ng-value="fundtype" ng-change="togDivfreq($index)" data-val="{{fundtype.value}}" value="{{fundtype.name}}" ><label class="ml-2" for="chk-{{fundtype.id}}">{{fundtype.name}}</label></div>';
	$html .= '</div>';	
	$html .= '</div>';	

	$html .= '</div>';
	$html .= '</div>';	
	
	$html .= '<div class="row"><div class="col-md-12 mb-4" ><a data-toggle="collapse" href="#70291516059420">[Advanced Search]</a></div></div>';

	$html .= '<div id="70291516059420" class="panel-collapse collapse in">';	
	
	$html .= '<div class="row mb-4">';	
	$html .= '<div class="col-sm-6" >';	
	$html .= '<div class="mb-3" ><rzslider rz-slider-model="min_investment.minValue" rz-slider-high="min_investment.maxValue" rz-slider-options="min_investment.options"></rzslider></div>';
	$html .= '<div class="mb-3" ><rzslider rz-slider-model="managed_assets_m.minValue" rz-slider-high="managed_assets_m.maxValue" rz-slider-options="managed_assets_m.options"></rzslider></div>';	
	$html .= '<div class="mb-3" ><rzslider rz-slider-model="exp_ratio_net_av.minValue" rz-slider-high="exp_ratio_net_av.maxValue" rz-slider-options="exp_ratio_net_av.options"></rzslider></div>';	
	$html .= '<div class="mb-3" ><rzslider rz-slider-model="leverage_fundamental.minValue" rz-slider-high="leverage_fundamental.maxValue" rz-slider-options="leverage_fundamental.options"></rzslider></div>';
	$html .= '<div class="mb-3" ><rzslider rz-slider-model="nav_yield_av.minValue" rz-slider-high="nav_yield_av.maxValue" rz-slider-options="nav_yield_av.options"></rzslider></div>';
	$html .= '<div class="mb-3" ><rzslider rz-slider-model="num_classes.minValue" rz-slider-high="num_classes.maxValue" rz-slider-options="num_classes.options"></rzslider></div>';	
	$html .= '</div>';
	
	$html .= '<div class="col-sm-6" >';
	$html .= '<div class="mb-3" ><rzslider rz-slider-model="tr_3mo_av.minValue" rz-slider-high="tr_3mo_av.maxValue" rz-slider-options="tr_3mo_av.options"></rzslider></div>';
	$html .= '<div class="mb-3" ><rzslider rz-slider-model="tr_ytd_av.minValue" rz-slider-high="tr_ytd_av.maxValue" rz-slider-options="tr_ytd_av.options"></rzslider></div>';		
	$html .= '<div class="mb-3" ><rzslider rz-slider-model="tr_1yr_av.minValue" rz-slider-high="tr_1yr_av.maxValue" rz-slider-options="tr_1yr_av.options"></rzslider></div>';		
	$html .= '<div class="mb-3" ><rzslider rz-slider-model="tr_3yr_av.minValue" rz-slider-high="tr_3yr_av.maxValue" rz-slider-options="tr_3yr_av.options"></rzslider></div>';
	$html .= '<div class="mb-3" ><rzslider rz-slider-model="tr_5yr_av.minValue" rz-slider-high="tr_5yr_av.maxValue" rz-slider-options="tr_5yr_av.options"></rzslider></div>';	
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
	// End non listed funds criteria box	

?>