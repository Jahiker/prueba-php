console.log('funcionando');
var video = document.getElementById('video');
var boton = document.getElementById('mute');
var i = document.querySelector('.material-icons');
video.muted = true;
video.autoplay = true;
video.loop = true;

console.log(i.innerHTML);

boton.addEventListener('click', function() {
    console.log('diste click mute');

    if (video.muted === true) {
        console.log('volumen encendido');
        i.innerHTML = 'volume_up';
        video.muted = false;
    } else if (video.muted === false) {
        console.log('volumen apagado');
        i.innerHTML = 'volume_off';
        video.muted = true;
    }
});