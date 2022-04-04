const displayCoursesMenu = courses => {
    const navElement = document.getElementById('courses');
    courses.forEach(course => {
        let child = document.createElement('div');
        child.setAttribute('id', course.id);
        child.setAttribute('class', 'course');
        child.innerHTML = `<a>${course.name}</a>`;
        navElement.appendChild(child);
    })
}

fetch('./endpoints/course.php')
     .then(response => response.json())
     .then(displayCoursesMenu);
