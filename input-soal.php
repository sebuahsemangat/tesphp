<?php
include ("koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="sample/css/sample.css" rel="stylesheet" media="screen" />
    <title>Input Soal</title>
    <link rel="stylesheet" href="codemirror/lib/codemirror.css">
    <link rel="stylesheet" href="codemirror/theme/monokai.css">
    <script src="codemirror/lib/codemirror.js"></script>
    <script src="codemirror/addon/edit/matchbrackets.js"></script>
    <script src="codemirror/addon/edit/closebrackets.js"></script>
    <script src="codemirror/mode/htmlmixed/htmlmixed.js"></script>
    <script src="codemirror/mode/xml/xml.js"></script>
    <script src="codemirror/mode/javascript/javascript.js"></script>
    <script src="codemirror/mode/css/css.js"></script>
    <script src="codemirror/mode/clike/clike.js"></script>
    <script src="codemirror/mode/php/php.js"></script>
    <style>.CodeMirror {border: solid 1px black;}</style>
</head>
<body>
<header>
	<div class="centered">
		<h1>Praktik PHP</h1>

		<input type="checkbox" id="menu-toggle" />
		<label for="menu-toggle"></label>
		  
		<nav>
			<ul>
				<li><a href="https://ckeditor.com/ckeditor-5">Home</a></li>
				<li><a href="https://ckeditor.com/docs/">Soal</a></li>
				
			</ul>
		</nav>
	</div>
</header>
<div class="message">
		<div class="centered">
			<h3>Input Soal!</h3>
		</div>
	</div>
<div class="centered">
    <?php
    if(!isset($_POST['submit']))
    {
        echo "";
    }
    else {
    $soal = addslashes($_POST['soal']);
    $jawaban = addslashes($_POST['jawaban']);

    //hapus awalan php, spasi, dan enter
    $bersihkan = str_replace(array("<?php","?>"," ","\r", "\n", "\t"),"",$jawaban);
    
        $sql = "INSERT INTO soal (soal, jawaban) VALUES ('$soal','$bersihkan')";
        $query = mysqli_query($konek, $sql);
        if($query)
        {
            echo "Soal berhasil diinput";
        }
        else
        {
            echo "Soal gagal diinput";
        }
    }
    ?>
    <form action="" method="post">
        <textarea name="soal" id="editor" cols="30" style="height:300px"></textarea>
        <br>
        <p>Jawaban</p>
        <textarea name="jawaban" cols="40" rows="10" id="code"></textarea>
        <br>
        
        <button type="submit" name="submit">Simpan Soal</button>
    </form>
</div>
<script src="js/ckeditor.js"></script>
<script>
	ClassicEditor
		.create( document.querySelector( '#editor' ), {
			// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
		} )
		.then( editor => {
			window.editor = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );
</script>
<script>
      var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
        lineNumbers: true,
        matchBrackets: true,
        mode: "application/x-httpd-php",
        indentUnit: 4,
        indentWithTabs: false,
        autoCloseBrackets: true
      });
</script>
</body>
</html>