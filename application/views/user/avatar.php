<?php  
	if (isset($_POST['x1'])) {
		$x1 = Functions::Encode($_POST['x1']);
		$x2 = Functions::Encode($_POST['x2']);
		$y1 = Functions::Encode($_POST['y1']);
		$y2 = Functions::Encode($_POST['y2']);
		$file_type = Functions::Encode($_POST['file_type']);

		if(isset($x1) && isset($x2) && isset($y1) && isset($y2)) {
			Functions::crop($x1, $y1, $x2, $y2, USER_IMAGES . $_SESSION['id'] . '/avatar.jpg', $file_type);
			header('Location: /user/');
		}
	}

	$this->addStyleSheet('/assets/css/imgareaselect-animated.css');
	$this->addScript('/assets/js/jquery.imgareaselect.pack.js', 'body');
?>
<form method="post" action="/user/avatar/" enctype="multipart/form-data">
	<input id="myfile" type="file" required name="filename[]" size="9"  multiple="true" onchange="test()"/><br />
	<input type="submit" value="Загрузить" />
</form>

<?php if ($_FILES): ?>
	<?php 
		$file = USER_IMAGES . $_SESSION['id'] . '/avatar.jpg';
		move_uploaded_file($_FILES['filename']['tmp_name'][0], $file); 
		$size = getimagesize($file);

		if ($size['0'] > 600) {
			Functions::resize($file, $_FILES['filename']['type'][0]);
		}
	?>
	<div id="image-container">
		<p class="fig">
			<img id="ladybug_ant" src="/assets/images/users/<?=$_SESSION['id']?>/avatar.jpg">
		</p>
	</div>

	<form class="send" method="post" action="/user/avatar/">
		<input id="x1" type="hidden" value="0" name="x1">
		<input id="x2" type="hidden" value="0" name="x2">
		<input id="y1" type="hidden" value="0" name="y1">
		<input id="y2" type="hidden" value="0" name="y2">
		<input id="file_type" type="hidden" value="<?=$_FILES['filename']['type'][0]?>" name="file_type">
		<button type="submit" class="btn btn-default">Сохранить</button>
	</form>
<?php endif; ?>
<script type="text/javascript">
	function endSelect(img, selection) {
		$('#x1').attr('value', selection.x1);
		$('#x2').attr('value', selection.x2);
		$('#y1').attr('value', selection.y1);
		$('#y2').attr('value', selection.y2);
	}

	$(function () {
		var t = $('#ladybug_ant').imgAreaSelect({x1: 0, x2: 150, y1: 0, y2: 150, minHeight: 150, minWidth: 150, aspectRatio: '1:1', handles: true, onSelectEnd: endSelect});
	});
</script>