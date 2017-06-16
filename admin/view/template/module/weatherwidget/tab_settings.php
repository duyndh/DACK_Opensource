<table id="Settings" class="table">
    <tr>
        <td class="col-xs-2"><h5><?php echo $text_panel_name; ?></h5><span class="help"><?php echo $text_panel_name_help; ?></span></td>
        <td class="col-xs-10">
            <div class="col-xs-4">
				<?php foreach ($languages as $lang) : ?>
                        <div class="input-group">
                            <span class="input-group-addon"><img src="view/image/flags/<?php echo $lang['image']; ?>" title="<?php echo $lang['name']; ?>" /> <?php echo $lang['name']; ?>:</span> 
                            <input type="text" class="form-control" name="<?php echo $moduleName; ?>[PanelName][<?php echo $lang['code']; ?>]" value="<?php if(isset($moduleData['PanelName'][$lang['code']])) { echo $moduleData['PanelName'][$lang['code']]; } else { echo "Weather Widget"; }?>" />           
                        </div>
                    <br />
				<?php endforeach;?>
            </div>
        </td>
    </tr>
    
    <tr>
        <td class="col-xs-2"> <h5><?php echo $text_panel_title; ?></h5><span class="help"><?php echo $text_panel_title_help; ?></span></td>
        <td class="col-xs-10">
            <div class="col-xs-4">
				<?php foreach ($languages as $lang) : ?>
                        <div class="input">       
                            <input type="text" class="form-control" name="<?php echo $moduleName; ?>[PanelTitle][<?php echo $lang['code']; ?>]" value="<?php if(isset($moduleData['PanelTitle'][$lang['code']])) { echo $moduleData['PanelTitle'][$lang['code']]; } else { echo "Weather Forecast"; }?>" />           
                        </div>
                    <br />
				<?php endforeach;?>
            </div>
        </td>
    </tr>
    
    
    <tr>
     <td class="col-xs-2"> <h5> <span class="required">* </span> <?php echo $weather_type; ?></h5><span class="help"><?php echo $weather_type_help; ?> </span></td>
        <td class="col-xs-10">
        <div class="col-xs-4">
               <select name="<?php echo $moduleName; ?>[WeatherType]" class="form-control" >
                      <option value="currentweather" <?php echo (!empty($moduleData['WeatherType']) && $moduleData['WeatherType'] == 'currentweather') ? 'selected=selected' : '' ?>><?php echo $weather_current; ?></option>
                      <option value="forecast1"  <?php echo (!empty($moduleData['WeatherType']) && $moduleData['WeatherType']== 'forecast1') ? 'selected=selected' : '' ?>><?php echo $weather_forecast1; ?></option>
                       <option value="forecast2" <?php echo (!empty($moduleData['WeatherType']) && $moduleData['WeatherType'] == 'forecast2') ? 'selected=selected' : '' ?>><?php echo $weather_forecast2; ?></option>
                      <option value="forecast3"  <?php echo (!empty($moduleData['WeatherType']) && $moduleData['WeatherType']== 'forecast3') ? 'selected=selected' : '' ?>><?php echo $weather_forecast3; ?></option>
                       <option value="forecast4" <?php echo (empty($moduleData['WeatherType']) || $moduleData['WeatherType'] == 'forecast4') ? 'selected=selected' : '' ?>><?php echo $weather_forecast4; ?></option>
              </select>
        </div>
        </td>
    </tr>
    
      <tr>
        <td class="col-xs-2"><h5> <span class="required">* </span><?php echo $auto_location; ?></h5><span class="help"><?php echo $auto_location_help; ?></span></td>
        <td class="col-xs-10">
        <div class="col-xs-4">
            <select name="<?php echo $moduleName; ?>[AutoLocation]" class="form-control">
                  <option value="yes" <?php echo (!empty($moduleData['AutoLocation']) && $moduleData['AutoLocation'] == 'yes') ? 'selected=selected' : '' ?>><?php echo $text_enabled; ?></option>
                  <option value="no"  <?php echo (empty($moduleData['AutoLocation']) || $moduleData['AutoLocation']== 'no') ? 'selected=selected' : '' ?>><?php echo $text_disabled; ?></option>
            </select>
        </div>
        </td>
     </tr>  
    
    <tr>
     <td class="col-xs-2"> <h5> <?php echo $entry_default_location; ?></h5><span class="help"><?php echo $entry_default_location_help; ?></span></td>
         <td>
          	<input type="hidden" name="<?php echo $moduleName; ?>[DefaultLocation]" value="<?php echo (!empty($moduleData['DefaultLocation'])) ? $moduleData['DefaultLocation'] : '' ?>" id="place-code" />
               <div class="row search-cities col-md-12" style="margin:0; padding:5px" >
                   <div id="custom-search-input">
                    <div class="input-group col-md-6" style="max-width:500px;padding-left:10px">
                        <input type="text" name="<?php echo $moduleName; ?>[DefaultLocationName]" value="<?php echo (!empty($moduleData['DefaultLocationName'])) ? $moduleData['DefaultLocationName'] : '' ?>" class="search-query form-control dropdown-toggle" data-bind="label" placeholder="Select City or Place" data-toggle="dropdown" style="margin:0; display:inline-block;width: 315px;" />
                        
                  <ul class="dropdown-menu dropdown-location" role="menu" style="font-size:12px; display:none; z-index:50; margin-left:10px;" ></ul>
                    </div>
                 </div>
           	 </div> 
     		</td>
          </tr>
     
     
      <tr>
        <td class="col-xs-2"><h5> <span class="required">* </span><?php echo $search_locations; ?></h5><span class="help"><?php echo $search_locations_help; ?></span></td>
        <td class="col-xs-10">
        <div class="col-xs-4">
            <select name="<?php echo $moduleName; ?>[OtherCities]" class="form-control">
                  <option value="yes" <?php echo (!empty($moduleData['OtherCities']) && $moduleData['OtherCities'] == 'yes') ? 'selected=selected' : '' ?>><?php echo $text_enabled; ?></option>
                  <option value="no"  <?php echo (empty($moduleData['OtherCities']) || $moduleData['OtherCities']== 'no') ? 'selected=selected' : '' ?>><?php echo $text_disabled; ?></option>
            </select>
        </div>
        </td>
     </tr> 
        
	<tr>
        <td class="col-xs-2"><h5><?php echo $wrap_widget; ?></h5><span class="help"><?php echo $wrap_widget_help; ?></span></td>
        <td class="col-xs-10">
        <div class="col-xs-4">
            <select name="<?php echo $moduleName; ?>[WrapInWidget]" class="form-control">
                  <option value="yes" <?php echo (empty($moduleData['WrapInWidget']) || $moduleData['WrapInWidget'] == 'yes') ? 'selected=selected' : '' ?>><?php echo $text_enabled; ?></option>
				   <option value="no"  <?php echo (!empty($moduleData['WrapInWidget']) && $moduleData['WrapInWidget']== 'no') ? 'selected=selected' : '' ?>><?php echo $text_disabled; ?></option>
            </select>
        </div>
        </td>
    </tr>
	<tr>
        <td class="col-xs-2"><h5><?php echo $custom_css; ?></h5><span class="help"><?php echo $custom_css_help; ?></span></td>
        <td class="col-xs-10">
            <div class="col-xs-4">
                <div class="form-group" style="padding-top:10px;">
                    <textarea class="form-control" name="<?php echo $moduleName; ?>[CustomCSS]" placeholder="<?php echo $custom_css_placeholder; ?>" rows="4"><?php if(isset($moduleData['CustomCSS'])) { echo $moduleData['CustomCSS']; } else { echo ""; }?></textarea>
                </div>
            </div>
        </td>
    </tr>


<script><!--
var token = '<?php echo $_GET["token"]; ?>';

//Dropdown for setting default location

$(document).delegate("a.place-content",'click',function(){
	$('.dropdown-menu').css({'display':'none'}); 
	var code = $(this).data('code');
	$('#place-code').val(code);
	$('.search-query').val($(this).text());
}); 



var setPlace = function(location) 
	{
		if (!location) {
			return;	
		} 
		var place = location.place;
		var htmlGeneric = '<li class="place-li"> <a class="place-content" data-code="DCODE" href="javascript:void(0)">CONTENT </a></li>';
		$.each(place, function(key, content) {
				if (content && content.placeTypeName && content.admin1 && content.country) {
					var htmlToAppend = htmlGeneric.replace('CONTENT',content.placeTypeName.content+': '+content.name+', '+ content.admin1.type+': '+ content.admin1.content+', Country: '+ content.country.content+', '+ content.woeid).replace('DCODE',content.woeid);
					$('.dropdown-location').append(htmlToAppend);
				}
	}); 
} 


var getPlace = function(city) {

	$.ajax(
	{
		url: 'index.php?route=module/weatherwidget/getplace&token='+token+'&city='+city,
		dataType: 'JSON',
		success: function(data) {
			if (data) { 
				setPlace(data.query.results);
			}
		}

	}
	); 
} 


$('.search-query').keyup(function(key) {
	//  AJAX request for getting the places based on user input

	$( 'li.place-li' ).remove();
	var city = $(this).val(); 

	
	if (city.length > 2) {
		
		setTimeout(function() {
		getPlace(city);
		}, 200)
		
		$( document.body ).on( 'keyup', '.dropdown-location li', function( event ) {
	
			   var $target = $( event.currentTarget );
			   $target.closest( '.search-cities' )
				  .find( '[data-bind="label"]' ).text( $target.text() )
				  .end()
				  .children( '.dropdown-toggle' ).dropdown( 'toggle' )
				   return false;
		});
				$('.dropdown-menu').css({'display':'block'});	
	}
	
	else { $('.dropdown-menu').css({'display':'none'}); }		

});


//--></script> 
</table>
