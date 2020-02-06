// DRAG DROP
const fileInput = document.getElementById('form-input_file'),
      dropZone = document.getElementById('drop-zone');
      
if(dropZone != null) {
    dropZone.addEventListener('click', () => fileInput.click());
    fileInput.addEventListener('change', (e) => {
        eliminarImg.style.display = "block";
        printInResult();
    });
    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.classList.add('drop-zone_active')
    });
    dropZone.addEventListener('dragleave', (e) => {
        e.preventDefault();
        dropZone.classList.remove('drop-zone_active')
    });
    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.classList.remove('drop-zone_active')
        fileInput.files = e.dataTransfer.files;
        eliminarImg.style.display = "block";
        printInResult();
    });
    
    // Subir imágenes
    let contenedorImg = document.querySelector('.input-image');
    let eliminarImg = document.querySelector('.eliminar-img');

    eliminarImg.addEventListener('click', () => {
        contenedorImg.removeChild(document.querySelector('.input-image > img'));
        eliminarImg.style.display = "none";
    });
    
    function printInResult() {
        for (const file of fileInput.files) {
            const fileReader = new FileReader()
            fileReader.readAsDataURL(file);
            let img = document.createElement('img');
            fileReader.addEventListener('load', (e) => {
                img.setAttribute('src', e.target.result);
            });
            fileReader.addEventListener('loadend', (e) => {
                contenedorImg.appendChild(img);
            });
        }
    }
}

// Recargar ponentes ajax
var genericAjax = function (url, data, type, callBack) {
    $.ajax({
        url: url,
        data: data,
        type: type,
        dataType : 'json',
    })
    .done(function( json ) {
        // console.log('ajax done');
        // console.log(json);
        callBack(json);
    })
    .fail(function( xhr, status, errorThrown ) {
        // console.log('ajax fail');
        // console.log(xhr);
    })
    .always(function( xhr, status ) {
        // console.log('ajax always');
    });
};

$('#actualizar-ponentes').click(function(e) {
    e.preventDefault();
    $('#id_speaker').empty();
    var $this = $(this);
    $(this).addClass('rotate');
    setTimeout(function(){ $this.removeClass('rotate'); }, 300);
    
    genericAjax('../speakersajax', null, 'get', function(param1){
        // alert(param1);
        $('#id_speaker').append(getSpeakers(param1));
    });
})

var getSpeakerOption = function(option) {
    var content = '';
        content = `<option value="${option['id']}">${option['name']}</option>`;
        // content += `<td>${row[property]}</td>`;
    return content;
}

function getSpeakers(response) {
    var speakersData = response.speakers;
    var content = '';
    for (var i = 0; i < speakersData.length; i++) {
        content += getSpeakerOption(speakersData[i]);
    }
    return content;
}

// Obtener certificado ponencia
    var t;
    var player, playing = false;
    function onYouTubeIframeAPIReady() {
        let urlVideo = document.getElementById('video').dataset.url;
        urlVideo = urlVideo.split('/')[3];
        player = new YT.Player('video', {
            height: '360',
            width: '640',
            videoId: urlVideo,
            playerVars: { 
                'autoplay': 0,
                'controls': 0,
                'disablekb': 1,
                'rel' : 0,
                'fs' : 1,
                'showinfo': 0,
                'modestbranding': 0,
                'iv_load_policy': 3,
                'enablejsapi': 1,
            },
            events: {
                'onStateChange': onPlayerStateChange
            }
        });
    }

    function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING) {
            // alert('joder');
            startCheckTime();
            playing = true;
        }
        
        else if(event.data == YT.PlayerState.PAUSED){
            stopCheckTime();
            playing = false;
        }
    }
    
    function startCheckTime() {
        if(!checkTime()) {
            t = setTimeout(startCheckTime, 1000);
        } else {
            clearTimeout(t);
            // let title = document.getElementById('titulo').textContent;
            // var urlEnlace;
            // genericAjax('../urlcertificate/' + title, null, 'get', function(pp){
            //     urlEnlace = pp.url;
            // });
            setTimeout(function() {
                let a = document.createElement('a');
                a.href = '../certificate';
                a.text = "Descargar Certificado";
                a.className = 'button button_pay button_small button_margin';
                document.querySelector('.wrapper').appendChild(a);
            }, 500)
        }
    }
    
    function stopCheckTime() {
        clearTimeout(t);
    }
    
    function checkTime() {
        return player.getCurrentTime() == player.getDuration();
    }