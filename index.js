document.getElementById('generate-btn-text').addEventListener('click', function() {
  var inputValue = document.getElementById('text-input').value;
  if (inputValue !== '') {
    generateQRCode(inputValue);
  } else {
    alert('Veuillez entrer du texte.');
  }
});

document.getElementById('generate-btn-file').addEventListener('click', function() {
  var fileInput = document.getElementById('file-input');
  if (fileInput.files.length > 0) {
    var file = fileInput.files[0];
    uploadFile(file);
  } else {
    alert('Veuillez choisir un fichier.');
  }
});

function uploadFile(file) {
  var formData = new FormData();
  formData.append('file', file);

  fetch('PATH', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      generateQRCode(data.filePath);
    } else {
      alert('Erreur lors du téléversement du fichier.');
    }
  })
  .catch(error => {
    console.error('Erreur:', error);
    alert('Une erreur s\'est produite lors du téléversement du fichier.');
  });
}

function generateQRCode(text) {
  var qrCodeDiv = document.getElementById('qr-code');
  qrCodeDiv.innerHTML = '';

  var loadingDiv = document.createElement('div');
  loadingDiv.classList.add('loading-circle');
  qrCodeDiv.appendChild(loadingDiv);

  setTimeout(function() {
    var qrCodeURL = "https://quickchart.io/qr?text=" + encodeURIComponent(text);
    var img = document.createElement('img');
    img.src = qrCodeURL;
    qrCodeDiv.innerHTML = '';
    qrCodeDiv.appendChild(img);
  }, 1000);
}
