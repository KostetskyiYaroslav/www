

var SensorsModel = {
  insideHumidity:  null,
  outsideHumidity: null,
  insideTemperature:  null,
  outsideTemperature: null,
  //init
  init: function(){ 
    this.insideHumidity = loadLiquidFillGauge("inside-humidity", 0);
    this.outsideHumidity = loadLiquidFillGauge("outside-humidity", 0);
 
    var temperatureConfig = liquidFillGaugeDefaultSettings();
    temperatureConfig.circleColor = "#FF6666";
    temperatureConfig.textColor = "#FF4555";
    temperatureConfig.waveTextColor = "#FFAAAA";
    temperatureConfig.waveColor = "#FFEEEE";

    temperatureConfig.displayPercent = false;
    temperatureConfig.units = "°C";
    temperatureConfig.minValue = -20;
     temperatureConfig.maxValue = 40;
    this.insideTemperature = loadLiquidFillGauge("inside-Temperature", 0, temperatureConfig);
    this.outsideTemperature = loadLiquidFillGauge("outside-Temperature", 0, temperatureConfig);
   
  },

  setValueInsideTemperature: function (value) {
    if (value){
      this.insideTemperature.update(value);
    }
  },

  setValueOutsideTemperature: function (value) {
    if (value){
      this.outsideTemperature.update(value);
    }
  },

  setValueInsideHumidity: function (value) {
    if (value){
      this.insideHumidity.update(value);
    }
  },

   setValueOutsideHumidity: function (value) {
    if (value){
      this.outsideHumidity.update(value);
    }
  }

};
  var SensorsController={
   update: function (){
      //outside
       $.ajax("api/sensors/outside/temperature.php").done(function(data) {
          if ( data ) {
            SensorsModel.setValueOutsideTemperature(data.data);
          }
      });
      
       $.ajax("api/sensors/outside/humidity.php").done(function(data) {
          if ( data ) {
               SensorsModel.setValueOutsideHumidity(data.data);
          }
      });
      
      //inside
       $.ajax("api/sensors/inside/temperature.php").done(function(data) {
          if ( data ) { 
            SensorsModel.setValueInsideTemperature(data.data);
          }
      });
      
       $.ajax("api/sensors/inside/humidity.php").done(function(data) {
          if ( data ) {
               SensorsModel.setValueInsideHumidity(data.data);
          }
      });
      
    }
  };

$(document).ready(function($) {
  SensorsModel.init();
  $(function() {
    doUpdate();

    function doUpdate() {
       setTimeout(doUpdate,3*60000);
       SensorsController.update();
    }
});
});
    
  
