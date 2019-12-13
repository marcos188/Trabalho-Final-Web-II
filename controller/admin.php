
<head>
    <meta charset="utf-8">
    <title>View HTML</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.plot.ly/plotly-1.2.0.min.js"></script>

    <style>
    i:hover{
      color: red;
    }
    </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-danger" >
    <a class="navbar-brand" href="#" style='color:white;'>WeHatePoverty</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </nav>
  <div class="row">
    <div class="container">
      <br>
      <h1 class="display-4">Administrador altere aqui as configurações
        do seu questionário</h1><br>
      <form class="form">
            <label for="idHunger">id</label>
            <input type="number" name="idHunger" id="idHunger">
            <label for="countryHunger">País</label>
            <input type="text" name="countryHunger" id="countryHunger">
            <label for="valueHunger">Taxa</label>
            <input type="number" name="valueHunger" id="valueHunger">
            <button type="button" onclick=hungerPut() class="btn btn-danger">Update</button>
            <label class="h3">  Fome </label>
      </form>

        <form class="form">
              <label for="idPoor">id</label>
              <input type="number" name="idPoor" id="idPoor">
              <label for="countryPoor">País</label>
              <input type="text" name="countryPoor" id="countryPoor">
              <label for="valuePoor">Taxa</label>
              <input type="number" name="valuePoor" id="valuePoor">
              <button type="button" onclick=poorPut() class="btn btn-danger">Update</button>
              <label class="h3"> Pobreza </label>
        </form>

          <form class="form">
                <label for="idWork">id</label>
                <input type="number" name="idWork" id="idWork">
                <label for="countryWork">País</label>
                <input type="text" name="countryWork" id="countryWork">
                <label for="valueWork">Taxa</label>
                <input type="number" name="valueWork" id="valueWork">
                <input type="hidden" name="rendimento" id="rendimento">
                <button type="button" onclick=workPut() class="btn btn-danger">Update</button>
                <label class="h3"> Fome </label>
          </form>
    </div>
</div>
<div class="row">
  <div class="container">
    <br>
    <h1 class="display-4">Aqui estão as respostas do seu usuários</h1><br>
    <div id="ans0" style="width:600px;height:250px;"></div>
    <div id="ans1" style="width:600px;height:250px;"></div>
    <div id="ans2" style="width:600px;height:250px;"></div>
  </div<
</div>
    <script>
        $.ajax({
            type: "GET",
            url: 'Controllers/hunger.php',
            success: function(data){
                  document.getElementById('idHunger').value=data['id'];
                  document.getElementById('countryHunger').value=data['pais'];
                  document.getElementById('valueHunger').value=data['indice'];
                }
              });

        $.ajax({
            type: "GET",
            url: 'Controllers/poor.php',
            success: function(data){
                      document.getElementById('idPoor').value=data['id'];
                      document.getElementById('countryPoor').value=data['pais'];
                      document.getElementById('valuePoor').value=data['indice'];
                    }
                });
        $.ajax({
            type: "GET",
            url: 'Controllers/work.php',
            success: function(data){
                        document.getElementById('idWork').value=data['id'];
                        document.getElementById('countryWork').value=data['regiao'];
                        document.getElementById('valueWork').value=data['taxaDesocupacao'];
                        document.getElementById('rendimento').value=data['rendimentoMedio'];
                        plotAll();

                    }
                });
      function plotAll(){
          $.ajax({
                type: "GET",
                  url: 'Controllers/adminPoor.php',
                    success: function(data){
                      plotBox(0,data,'valueHunger','ans0');
                      plotBox(1,data,'valuePoor','ans1');
                      plotBox(2,data,'valueWork','ans2');
                        }
                      });
                    }
        function plotBox(row,data,id,tag){
            TESTER = document.getElementById(tag);
            var objLen = Object.keys(data).length;
            var obj = [];
            var ans  =document.getElementById(id).value;
            for (i=0;i<objLen;i++){
              if (data[i].ansType == row){
                obj.push(data[i].value);
              }
            }
              trace = {
                y: obj,
                type: 'box'
              };
              trace2 = {
                y: [ans],
                type: 'box'
              };

              Plotly.newPlot(TESTER,[trace,trace2]);
        }
/* Adicionar o codigo seguinte a uma funcao para plotar o boxplot */


          // var y0 = [];
          // var y1 = [];
          // for (var i = 0; i < 50; i ++) {
          // 	y0[i] = Math.random();
          // 	y1[i] = Math.random() + 1;
          // }
          //
          // var trace1 = {
          //   y: y0,
          //   type: 'box'
          // };
          //
          // var trace2 = {
          //   y: y1,
          //   type: 'box'
          // };
          //
          // var data = [trace1, trace2];
          //
        	// Plotly.newPlot( TESTER, data);

          /* fim dos dados */

    function hungerPut(){
          id = document.getElementById('idHunger').value;
          country = document.getElementById('countryHunger').value;
          value = document.getElementById('valueHunger').value;
          data = {id:id,country:country,value:value};

              $.ajax({
                    url: 'Controllers/adminHunger.php',
                    type: 'POST',
                    data: data,
                    success: function(data) {
                      alert('Load was performed.');
                    }
                });
                }
    function poorPut(){
          id = document.getElementById('idPoor').value;
          country = document.getElementById('countryPoor').value;
          value = document.getElementById('valuePoor').value;
          data = {id:id,country:country,value:value};

        $.ajax({
                  url: 'Controllers/adminPoor.php',
                type: 'POST',
                data: data,
                success: function(data) {
                alert('Load was performed.');
                          }
                });
            }
    function workPut(){
              id = document.getElementById('idHunger').value;
              country = document.getElementById('countryHunger').value;
              value = document.getElementById('valueHunger').value;
              data = {id:id,country:country,value:value};

            $.ajax({
                      url: 'Controllers/adminHunger.php',
                    type: 'POST',
                    data: data,
                    success: function(data) {
                    alert('Load was performed.');
                        }
                    });
                }
    </script>

</body>
