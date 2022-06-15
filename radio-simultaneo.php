<!--radio 1-->
<div class="radio-player-container">
  <div class="radio-player-wrapper">
      <div class="radio-content">
        <div id="audio-player-container" class="custom-radio-player" >
          <audio id="player" src="<?=$urlCiudadDestino?>" preload="metadata">
          </audio>
          <span id="play-icon5" class="pause"></span>
          <input style="display: none;" type="range" id="seek-slider" max="100" value="0">
          <span id="duration" class="time" style="display: none;">0:00</span>
          <button class="unmuted" id="mute-icon" style="display: none;"></button>
          <input style="display: none;" type="range" id="volume-slider" max="100" value="0">
        </div>
      </div>
  </div>
</div>

<script type="text/javascript">
$( document ).ready(function() {
const seekSlider = document.getElementById('seek-slider');
const volumeSlider = document.getElementById('volume-slider');
const audioPlayerContainer = document.getElementById('audio-player-container');

const playIcon3 = document.getElementById('play-icon3');
const muteIcon = document.getElementById('mute-icon');

let playState = 'pause';
let muteState = 'unmute';
let rAF = null;
   
const showRangeProgress = (rangeInput) => {
    if(rangeInput === seekSlider) {
      audioPlayerContainer.style.setProperty('--seek-before-width', rangeInput.value / rangeInput.max * 100 + '%');
    } else {
      audioPlayerContainer.style.setProperty('--volume-before-width', rangeInput.value / rangeInput.max * 100 + '%');
    }
}

let audio = document.querySelector('audio');

let getaudio3 = $("#player3")[0];
let getaudio = $("#player")[0];
audio=getaudio;

getaudio.play();
const durationContainer = document.getElementById('duration');

const calculateTime = (secs) => {
  const minutes = Math.floor(secs / 60);
  const seconds = Math.floor(secs % 60);
  const returnedSeconds = seconds < 10 ? `0${seconds}` : `${seconds}`;
  return `${minutes}:${returnedSeconds}`;
}

const displayDuration = () => {
  durationContainer.textContent = calculateTime(audio.duration);
}

if (audio.readyState > 0) {
  displayDuration();
} else {
  audio.addEventListener('loadedmetadata', () => {
    displayDuration();
  });
}

const setSliderMax = () => {
    seekSlider.max = Math.floor(audio.duration);
}

const displayBufferedAmount = () => {
    const bufferedAmount = Math.floor(audio.buffered.end(audio.buffered.length - 1));
    audioPlayerContainer.style.setProperty('--buffered-width', `${(bufferedAmount / seekSlider.max) * 100}%`);
}

if (audio.readyState > 0) {
    displayDuration();
    setSliderMax();
    displayBufferedAmount();
    volumeSlider.value = (audio.volume * 100);
} else {
    audio.addEventListener('loadedmetadata', () => {
      displayDuration();
      setSliderMax();
      displayBufferedAmount();
      volumeSlider.value = (audio.volume * 100);
    });
}

audio.addEventListener('progress', displayBufferedAmount);

const whilePlaying = () => {
  seekSlider.value = Math.floor(audio.currentTime);
  durationContainer.textContent = calculateTime(seekSlider.value);
  audioPlayerContainer.style.setProperty('--seek-before-width', `${seekSlider.value / seekSlider.max * 100}%`);
  raf = requestAnimationFrame(whilePlaying);
}

if (banderaProgramacion_1!=0) {
  const playIcon = document.getElementById('play-icon');
console.log(playIcon);
playIcon.addEventListener('click', () => {

  if(playState === 'play') {

    audio.play();
    getaudio.play();
    playIcon.classList.remove('play');
    playIcon.classList.add('pause');
    playIcon3.classList.remove('play');
    playIcon3.classList.add('pause');
    requestAnimationFrame(whilePlaying);
    playState = 'pause';

  } else {
 
    audio.pause();
    playIcon.classList.remove('pause');
    playIcon.classList.add('play');
    playIcon3.classList.remove('pause');
    playIcon3.classList.add('play');
  
    playState = 'play';
  }
});
}else{
const playIcon6 = document.getElementById('play-icon6');

playIcon6.addEventListener('click', () => {

  if(playState === 'play') {

    audio.play();
    getaudio.play();
    
    playIcon3.classList.remove('play');
    playIcon3.classList.add('pause');
    if (banderaProgramacion_1!=0) {
    playIcon.classList.remove('play');
    playIcon.classList.add('pause');
  }else{
    playIcon6.classList.remove('play');
    playIcon6.classList.add('pause');
  }
    requestAnimationFrame(whilePlaying);
    playState = 'pause';
  
  } else {
 
    audio.pause();
    
    playIcon3.classList.remove('pause');
    playIcon3.classList.add('play');
if (banderaProgramacion_1!=0) {   
    playIcon.classList.remove('pause');
    playIcon.classList.add('play');
  }else{
    playIcon6.classList.remove('pause');
    playIcon6.classList.add('play');
  }
    
    playState = 'play';
  }
});
}

playIcon3.addEventListener('click', () => {
  if(playState === 'play') {
    audio.play();
    getaudio.play();
    playIcon3.classList.remove('play');
    playIcon3.classList.add('pause');
if (banderaProgramacion_1!=0) {
  const playIcon = document.getElementById('play-icon');
    playIcon.classList.remove('play');
    playIcon.classList.add('pause');
}else{
  const playIcon6 = document.getElementById('play-icon6');
  playIcon6.classList.remove('play');
    playIcon6.classList.add('pause');
}
    requestAnimationFrame(whilePlaying);
    playState = 'pause';
    
  } else {
    
    audio.pause();
    getaudio.pause();
    
   if (banderaProgramacion_1!=0) {
   const playIcon = document.getElementById('play-icon'); 
    playIcon.classList.remove('pause');
    playIcon.classList.add('play');
  }else{
    const playIcon6 = document.getElementById('play-icon6');
    playIcon6.classList.remove('pause');
    playIcon6.classList.add('play');
  }
    playIcon3.classList.remove('pause');
    playIcon3.classList.add('play');
  
    playState = 'play';
  }
});


seekSlider.addEventListener('change', () => {
  audio.currentTime = seekSlider.value;
});

audio.addEventListener('timeupdate', () => {
  seekSlider.value = Math.floor(audio.currentTime);
});

seekSlider.addEventListener('input', () => {
  durationContainer.textContent = calculateTime(seekSlider.value);
  if(!audio.paused) {
   
  }
});

seekSlider.addEventListener('change', () => {
  audio.currentTime = seekSlider.value;
  if(!audio.paused) {
    requestAnimationFrame(whilePlaying);
  }
});

volumeSlider.addEventListener('input', (e) => {
  const value = e.target.value;

  audio.volume = value / 100;
});

muteIcon.addEventListener('click', () => {
  if(muteState === 'unmute'){
    audio.muted = true;
    muteState = 'muted';
    muteIcon.classList.remove('unmuted');
    muteIcon.classList.add('muted');
  } else {
    audio.muted = false;
    muteState = 'unmute';
    muteIcon.classList.remove('muted');
    muteIcon.classList.add('unmuted');
  }
})

/* Implementation of the Media Session API */


});
</script>