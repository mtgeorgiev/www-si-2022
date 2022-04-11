const navElementOnClick = event => {
    const courseId = event.target.getAttribute('id');

    fetch('./endpoints/course.php?id=' + courseId)
        .then(response => response.json())
        .then(displayCoursePage);
}

const displayCoursesMenu = courses => {
    const navElement = document.getElementById('courses');
    courses.forEach(course => {
        let child = document.createElement('div');
        child.setAttribute('class', 'course');
        child.innerHTML = `<a id="${course.id}">${course.name}</a>`;
        navElement.appendChild(child);
        document.getElementById(course.id)
                .addEventListener('click', navElementOnClick);
    })
}

const displayCoursePage = course => {

    const courseHTMLContent = `<header>${course.name}</header>
    <article>
        <div class="lecturer">${course.lecturer}</div>
        <div class="description">${course.description}</div>
        <div class="type"><span class="key">Тип:</span><span class="value">${course.type}</span></div>
    </article>`;

    document.getElementById('course-info').innerHTML = courseHTMLContent;
}

fetch('./endpoints/course.php')
     .then(response => response.json())
     .then(displayCoursesMenu);
