
const myMouseoverHandler = event => {
    console.log(event);
}


const goCourseElement = document.getElementById('1');
goCourseElement.querySelector('a')
               .addEventListener('mouseover', myMouseoverHandler);