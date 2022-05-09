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

    document.querySelectorAll('#courses .course a')
        .forEach(element => {
            if (element.getAttribute('id') == course.id) {
                element.parentElement.setAttribute('class', 'course selected');
            } else {
                element.parentElement.setAttribute('class', 'course');
            }
        });
}

const removeLoginFormElement = () => {
    const loginForm = document.getElementById("login-form");
    if (loginForm) {
        loginForm.parentElement.removeChild(loginForm);
    }
}

const displayLoginForm = () => {

    removeLoginFormElement();

    const loginFormElement = document.createElement('div');
    loginFormElement.innerHTML = `
        <form id="login-form">
            <input type="text" name="username" placeholder="Потребителско име" />
            <input type="password" name="password" placeholder="Парола"/>
            <input type="submit" value="Submit">
        </form>`;

    document.getElementById("content-wrapper").appendChild(loginFormElement);

    document.getElementById("login-form").addEventListener("submit", submitLoginForm)
}

const submitLoginForm = event => {

    event.preventDefault();

    const form = event.target;

    const body = {
        'username': form.username.value,
        'password': form.password.value
    }

    fetch('./endpoints/session.php', {
            method: "POST",
            body: JSON.stringify(body)
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                removeLoginFormElement();
                // display message user ia logged / redirect to homepage
            } else {
                // display error message
            }
        });

}

fetch('./endpoints/course.php')
     .then(response => response.json())
     .then(displayCoursesMenu);


     document.getElementById("login").addEventListener('click', displayLoginForm);

