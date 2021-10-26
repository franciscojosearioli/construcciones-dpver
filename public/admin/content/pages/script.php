<div class="row">
<div id="myTimeline"></div> </div>
<script type="text/javascript">

          var ev = [{
              id : 1,
              name : "Inicio de obra",
              on : new Date(2013,7,15)
            },{
              id : 2,
              name : "Plazo original",
              on : new Date(2016,7,15)
            },{
              id : 3,
              name : "1º Ampliacion",
              on : new Date(2016,7,15)
            },{
              id : 4,
              name : "Plazo vigente",
              on : new Date(2016,10,15)
            }]

      var tl = $('#myTimeline').jqtimeline({
              events : ev,
              numYears:2,
              startYear:2013,
              gap:25,
              click:function(e,dato){
                alert(dato.name);
              }
            });
    </script>