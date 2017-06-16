<?php if (isset($data['Enabled']) && ($data['Enabled']=='yes')) { ?>

<?php $wClass = (!empty($data['WrapInWidget']) && $data['WrapInWidget'] == 'yes') ? 'box' : ''; ?>

<?php if(!empty($data['CustomCSS'])): ?>
	<style>
    	<?php echo htmlspecialchars_decode($data['CustomCSS']); ?>
    </style>
<?php endif; ?>

<div class="<?php echo $wClass; ?> weatherWidgetWrapper" >
	<div class="box-heading weatherwidget-heading"><?php echo $data['PanelName']; ?></div>
	<div class="box-content container-fluid" style="text-align:center">

        <?php if (!empty($data['PanelTitle'])) { ?>	
			<h1> <?php echo $data['PanelTitle']; ?></h1>
        <?php } ?>
        


        <!-- Search Other Locations  -->       
        <div class="row search-cities col-md-12" style="margin:0; padding-bottom:20px;" >
			<div id="custom-search-input">
				<div class="input-group col-md-6 input-search" style="max-width:160px; margin: 0 auto; padding:0px;">
					<input type="text" class="search-query form-control dropdown-toggle" data-bind="label" placeholder="Select City or Place" data-toggle="dropdown" style="margin: 0px; display: inline-block;">
					<ul class="dropdown-menu dropdown-location" role="menu" style="font-size:18px; display:none"></ul>
				</div>
			</div>
        </div>
   
		<!-- Get Location Button  -->
		<?php if (isset($data['AutoLocation']) && ($data['AutoLocation']=='no')) { ?>
			<div class="row col-md-12" style="margin: 10px 0 0 0; padding-bottom:10px" > 
				<a class="btn btn-md btn-info btn-location" style="box-shadow: 0 8px 6px -6px #909090;"> Use my Location </a>
				<!-- <h4 class="current_location" id="location"></h3>   --> 
			</div>
		<?php } ?> 

		<!-- Displays current weather  -->   

		<div id="current_weather" class="row" style="display:none; max-width:450px; margin: 5px auto ;" >    

			<div class="col-md-12" style="padding:0px; margin-top: 10px;" >   

				<div class="well current-condition-well " >
       				<!-- Choose temperature format  -->  
                    <div class="btn-group">
                        <a class="btn btn-xs btn-primary form-temp-c" onclick="format_celsius()">C &deg </a></li></a>
                        <a class="btn btn-xs btn-primary form-temp-f" onclick="format_fahrenheit()">F &deg </a></li></a>	        
                    </div>
					<h2 class="weather-location" style="padding-top:5px;"></h2>

					<h1 style="margin:5px; font-size: 43px"><span> <img class="condition-image" /> <br /> <h4><span class="condition-text"></span> </h4>
					<span class="condition-temp"></span> <span class="units-temperature"></span> </span> </h1>

					<h4 class="zero zero-for"> <span class="forecast-condition-high" ></span>  /  <span class="forecast-condition-low" > </span></h4>

					<ul class="weather-details" style="list-style-type:none; font-size:16px; padding:0px;">
                        <li><span class="atmosphere-humidity"> </span> </li>
                        <li><span class="wind-speed"> </span> </li>
                        <li><span class="astronomy-sunrise"> </span>  </li>
                        <li><span class="astronomy-sunset"> </span> </li>  
					</ul>

					<h6 class="weather-date" style=" margin: 12px 0 5px 5px; font-size: 11px; color: #999; text-align: center;"> </h6>  
				</div>

			</div>    
		</div>

		<!-- Displays forecast for 1-5 days, depending on the admin choice  -->   

		<?php if (isset($data['WeatherType']) && ($data['WeatherType']!='currentweather')) { ?>
			<div id="forecast" class="row-five forecast"  >
            
			<?php
			$values = array(1=>'first',2=>'second',3=>'third',4=>'fourth');
			foreach ($values as $key=> $value):
			?>    
                
				<div class="col-row-5">
					<div class="thumbnail <?php echo $value; ?>" style="display:none">
						<h3 class="forecast-condition-day"></h3>
						<img class="forecast-condition-image">
							<div class="caption">
                                <h4 class="forecast-condition-text"></h4>
                                <h4 class="forecast-condition-high"></h4>
                                <h5 class="forecast-condition-low"></h5>
							</div>
					</div>
				</div>
                
                <?php 
                    if (isset($data['WeatherType']) && ($data['WeatherType'] == 'forecast'.($key))) {
                break;
                    }
                endforeach; ?>          

			</div>
		<?php } ?>  

	</div>    
</div>
	
<script>

var currentCode = <?php echo $weatherwidget_placecode ?>;
var values = {0:'zero',1:'first',2:'second',3:'third',4:'fourth'}

//if weather widget position is left or right
if ( $('.weatherWidgetWrapper').parent().attr('id')=='column-left' || $('.weatherWidgetWrapper').parent().attr('id')=='column-right') { 
    $('.col-row-5').css({'width':'100%'});
	$('.search-query').css({'width':'150px'});
	$('.search-cities').css({'padding':'0px'});
	$('.btn-location').css({'padding-left':'7px'});
	$('.btn-location').css({'padding-right':'7px'});
	$('.zero-for').css({'font-size':'16px'});
	$('.weather-details').css({'font-size':'14px'});
	$('.forecast-condition-text').css({'font-size':'17px'});
}


/* Get Default Weather on Page Load */

<?php if (!empty($data['DefaultLocation']))  { ?>
$(window).load(function() {
  var code= <?php echo $weatherwidget_placecode ?>;
  getWeather(code);
  $('.forecast').css({'display': 'block'});
});
<?php } else { ?>
  $('.forecast').css({'display': 'none'});
<?php } ?>



/* Get Weather of the location depending on the user input*/
$(document).delegate("a.place-content",'click',function(){
	$('.dropdown-menu').css({'display':'none'}); 
	$('.forecast').css({'display': 'block'});
	var code = $(this).data('code');
	currentCode=code;
    getWeather(code); 
});


/* If AutoLocation is enabled, the user location is detected automatically, if not, the
user may choose to use current location by pressing a button*/
<?php if (isset($data['AutoLocation']) && ($data['AutoLocation']=='no')) { ?>
$(document).delegate("a.btn-location",'click',function(){
	if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(showPosition);
				  $('.forecast').css({'display': 'block'});
			} else { 
				alert("Geolocation is not supported by this browser.");
			}
	
}); 
<?php } else { ?>

$(window).load(function() {
	$('.btn-location').css({'display': 'none'});
	
	if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(showPosition);
				$('.forecast').css({'display': 'block'});
			} else { 
				alert("Geolocation is not supported by this browser.");
			}
}); 

<?php } ?>

/* If the option Other Cities search is enabled, the user can check the weather 
for other locations*/
<?php if (isset($data['OtherCities']) && ($data['OtherCities']=='yes')) { ?>
	$('.search-cities').css({'display': 'block'});
<?php } else { ?>
	$('.search-cities').css({'display': 'none'});
<?php } ?>


// Setting the place of the dropdown menu for searching locations
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

// AJAX for Getting the place of the dropdown menu for searching locations
var getPlace = function(city) {

	$.ajax(
	{
		url: 'index.php?route=module/weatherwidget/getplace&city='+city,
		dataType: 'JSON',
		success: function(data) {
			if (data) { 
				setPlace(data.query.results);
			}
		}

	}
	);
}

// Setting the current weather and the forecast
var setWeather = function(weather) {

	$('#current_weather').css({'display': 'block'});	
	$('.thumbnail').css({'display': 'block'});		

	var location = weather.location.city+ ', ' +weather.location.region + '<br>' + weather.location.country;
	$('.weather-location').html(location);
	
	var date = 'Last updated: '+weather.item.condition.date
	$('.weather-date').html(date);
	
	var condition = weather.item.condition;
	$('.condition-image').attr('src','http://l.yimg.com/a/i/us/we/52/'+condition.code+'.gif');
	$('.condition-text').html(condition.text);
	$('.condition-temp').html(condition.temp+'&deg;');
	
	var units = weather.units;
	$('.units-temperature').html(units.temperature);
	
	var atmosphere = weather.atmosphere;
	$('.atmosphere-humidity').html('Humidity: '+ atmosphere.humidity+ "&#37");
	
	var wind = weather.wind;
	$('.wind-speed').html('Wind: '+ wind.speed+ "km/h");
	
	var astronomy = weather.astronomy;
	$('.astronomy-sunrise').html('Sunrise: '+ astronomy.sunrise);
	$('.astronomy-sunset').html('Sunset: '+ astronomy.sunset);
	
	
	var forecast = weather.item.forecast;
	
	$.each(values, function(key, value) {
		$('.'+value+' .forecast-condition-day').html(forecast[key].day)
		$('.'+value+' .forecast-condition-date').html(forecast[key].date);
		$('.'+value+' .forecast-condition-image').attr('src','http://l.yimg.com/a/i/us/we/52/'+forecast[key].code+'.gif');
		$('.'+value+' .forecast-condition-text').html(forecast[key].text);
		$('.'+value+' .forecast-condition-high').html('High: '+forecast[key].high+'&deg;');
		$('.'+value+' .forecast-condition-low').html('Low: '+forecast[key].low+'&deg;');   
    });
	
}


// AJAX for getting the weather and the forecast

var getWeather = function(code, format) {

	if (!format) {
		format = 'c';	
		$(function() {
    		$('.form-temp-c').addClass("active");      
  		});			 
	}
	
	$.ajax(
	{ 
		url: 'index.php?route=module/weatherwidget/getweather&code='+code+'&format='+format,
		dataType: 'JSON',
		success: function(data) {
			if (data) {
				setWeather(data.query.results.channel); 
			}
		}

	}
	);
}

//Search other cities. Might be disabled by the admin.
<?php if (isset($data['OtherCities']) && ($data['OtherCities']=='yes')) { ?>

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
				  .children('.dropdown-toggle' ).dropdown( 'toggle' )
				   return false;
		});
				$('.dropdown-menu').css({'display':'block'});	
	}
	
	else { $('.dropdown-menu').css({'display':'none'}); }		
	
});

<?php } ?>

//get current location jscript
		

		function showPosition(position) {
			var lat=position.coords.latitude;							 
			var long=position.coords.longitude;
			getWoeid(lat,long);	
		}
		

			var setWoeid = function(current_location) {
					
					var your_location= '<strong> Your current location is: </strong> '+ current_location.Result.city+', ' +current_location.Result.country;
					$('.current_location').html(your_location);
					
					var code=current_location.Result.woeid;
					currentCode=code;
					getWeather(code);			
			}
				
	
		var getWoeid = function(lat,long) {
		
			$.ajax(
			{
				dataType: 'JSON',
				url: 'index.php?route=module/weatherwidget/getwoeid&lat='+lat+'&long='+long,
				success: function(data) {
					if (data) { 
						setWoeid(data.query.results);
					}
				}
		
			}
			); 
		}
	
function format_celsius(){
   	$(function() {
		$('.form-temp-f').removeClass('active');  
    	$('.form-temp-c').addClass("active");      
  	});  
			
	var tempformat='c';
	getWeather(currentCode,tempformat);
}

function format_fahrenheit(){
	
	$(function() {                       
	    $('.form-temp-c').removeClass('active');  
    	$('.form-temp-f').addClass('active');      
  	});
	
	var tempformat='f';
	getWeather(currentCode,tempformat);
}

</script>


<?php } ?>
