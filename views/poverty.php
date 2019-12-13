<head>
    <meta charset="utf-8">
    <title>View HTML</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

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

  <div class="jumbotron text-center bg-light">
    <h1 class="display-4 animated slideInLeft delay-1s">A cada 100 pessoas no Brasil,
       quantas delas vivem abaixo da linha da pobreza?</h1><br><br>
      <?php
      $tot = 0;
      for ($j=0;$j<5;$j++){
        for ($i=0; $i<20; $i++){
            echo "<i class='fa fa-male fome animated fadeIn' style='font-size:60px;'
             id='".$tot."'> </i>&nbsp;";
             $tot ++;
        }
        echo "<br>";
      }
      ?>
    </div>
    <div class="row">
      <div class="container">
      <h3 id="user-ans" class="animated bounce"></h3>
      <h3 id="real-ans" class="animated bounce"></h3>
      <a class="btn btn-danger btn-block animated bounce" id="next-pg"
      style='display:none;' href="jobs.php">E o trabalho?</a>
      </div>
    </div>

    <script>
    function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }

    async function graph_answer(pct,indice,_callback){
    var lista = document.getElementsByClassName("fome");

    // changes icons color
    for (j=0;j<=pct;j++){
      lista[j].style.color = 'gray';
      await sleep(100 + j);
      }

    // adds answer text
      var value = parseInt(pct)+1;
      var ptag = document.getElementById("user-ans");
      var text = "Você respondeu que ";
      text += (value).toString();
      text += "% da população brasileira é pobre";
      ptag.innerHTML = text;
      await sleep(3000);
      _callback(indice,value);
    }

    async function show_answer(answer,user){
      var lista = document.getElementsByClassName("fome");
      for (j=0;j<answer;j++){
        lista[j].style.color = 'red';
        await sleep(100 + j)
      }
      await sleep(1000);

      // adds answer text
        var value = parseInt(answer);
        var ptag = document.getElementById("real-ans");
        var text = "Enquanto na verdade ";
        text += (value).toString();
        text += "% da população brasileira é pobre";
        ptag.innerHTML = text;

        var ptag = document.getElementById("next-pg");
        ptag.style.display = "block";


        $.ajax({
          type: "POST",
          url: 'Controllers/poor.php',
          data: {ansT:1,val:user},
          success: function(data){console.log(data)},
          failure: function(errMsg) {
              console.log(errMsg);
          }
        });

    }

    var lista = document.getElementsByClassName("fome");
    console.log(lista);
    for (i=0;i<lista.length;i++){
      lista[i].addEventListener('click',function(e){
        var lista = document.getElementsByTagName("i");
        e.target.style.color = 'gray';
        var pct  = e.target.id;

        $.ajax({
            type: "GET",
            url: 'Controllers/poor.php',
            success: function(data){
                graph_answer(pct,data['indice'],show_answer);
                //show_hunger(data['indice']);
                }
              });
      })

    }
    </script>

</body>
