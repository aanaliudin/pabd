const tombolCari = document.querySelector('.tombol-cari');
const keyword = document.querySelector('.keyword');
const container = document.querySelector('.container');

// Only run search functionality if elements exist
if (tombolCari && keyword && container) {
    //hilangkan tombol cari
    tombolCari.style.display = 'none';
    //event ketika kita menuliskan keyword
    keyword.addEventListener('keyup', function () {
// console.log('ok!');
//ajax
//xmlhttprequest
// const xhr = new XMLHttpRequest();
// xhr.onreadystatechange = function () {
// if (xhr.readyState == 4 && xhr.status == 200) {
// // console.log(xhr.responseText);
// container.innerHTML = xhr.responseText;
// }
// };
// xhr.open('get', 'ajax/ajax_cari.php?keyword=' + keyword.value);
// xhr.send();
//fetch()
fetch('ajax/ajax_cari.php?keyword=' + keyword.value)
.then((response) => response.text())
.then((response) => (container.innerHTML = response));
    });
}

// preview image untuk tambah dan ubah
function previewImage() {
    const gambar = document.querySelector('.previewImage');
    const imgPreview = document.querySelector('.img-preview');
    
    if (gambar.files && gambar.files[0]) {
        const ofReader = new FileReader();
        ofReader.readAsDataURL(gambar.files[0]);
        ofReader.onload = function (oFREvent) {
            imgPreview.src = oFREvent.target.result;
        };
    }
}

// Add event listener for file input change
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.querySelector('.previewImage');
    if (fileInput) {
        fileInput.addEventListener('change', previewImage);
    }
});
