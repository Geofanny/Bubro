const imageInput = document.getElementById('image');
const imgShow = document.getElementById('img_show');

imageInput.onchange = evt => {
	const [file] = imageInput.files;
	if (file) {
		imgShow.src = URL.createObjectURL(file);
	}
}