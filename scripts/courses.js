const pageDisplayMethods = {
    displayCoursePage: course => {

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
    },
    navElementOnClick: event => {
        const courseId = event.target.getAttribute('id');
    
        fetch('./endpoints/course.php?id=' + courseId)
            .then(response => response.json())
            .then(pageDisplayMethods.displayCoursePage);
    },
    displayCoursesMenu: courses => {
        const navElement = document.getElementById('courses');
        courses.forEach(course => {
            let child = document.createElement('div');
            child.setAttribute('class', 'course');
            child.innerHTML = `<a id="${course.id}">${course.name}</a>`;
            navElement.appendChild(child);
            document.getElementById(course.id)
                    .addEventListener('click', pageDisplayMethods.navElementOnClick);
        })
    },

    loadCourses: () => fetch('./endpoints/course.php')
        .then(response => response.json())
        .then(pageDisplayMethods.displayCoursesMenu),
};

const loginMethods = {

    checkLoginStatus: () => {
        return fetch('./endpoints/session.php')
            .then(response => {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error();
                }
            })
    },

    removeFormElement: () => {
        const loginForm = document.getElementById("login-form");
        if (loginForm) {
            loginForm.parentElement.removeChild(loginForm);
        }
    },

    displayForm: () => {

        loginMethods.removeFormElement();
    
        const loginFormElement = document.createElement('div');
        loginFormElement.innerHTML = `
            <form id="login-form">
                <input type="text" name="username" placeholder="Потребителско име" />
                <input type="password" name="password" placeholder="Парола"/>
                <input type="submit" value="Влез!">
            </form>`;
    
        document.getElementById("content-wrapper").appendChild(loginFormElement);
    
        document.getElementById("login-form").addEventListener("submit", loginMethods.submitForm)
    },

    clearErrorMessages: () => {
        document.querySelectorAll('#login-form .error-message')
            .forEach(errorMessage => {
                errorMessage.parentElement.removeChild(errorMessage);
            })
    },

    displayErrorMessage: errorMessage => {

        const errorElement = document.createElement('div');
        errorElement.innerText = errorMessage;
        errorElement.setAttribute("class", "error-message");
    
        document.getElementById('login-form').appendChild(errorElement);
    },

    submitForm: event => {

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
            .then(response =>  {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error();
                }
            })
            .then(result => {
                loginMethods.clearErrorMessages();
                if (result.success) {
                    document.location.reload();
                } else {
                    // display error message
                    loginMethods.displayErrorMessage("Потребител с такава парола не съществува");
                }
            })
            .catch(() => {
                loginMethods.clearErrorMessages();
                loginMethods.displayErrorMessage("Неуспешен опит за влизане. Опитайте отново след малко.");
            });
    }
}

const logout = () => {
    fetch('./endpoints/session.php', {
        method: 'DELETE'
    })
    .then(() => {
        document.location.reload();
    });
}

document.getElementById('login').addEventListener('click', loginMethods.displayForm);
document.getElementById('logout').addEventListener('click', logout);

loginMethods.checkLoginStatus()
    .then(loginStatus => {
        if (loginStatus.logged) {
            document.getElementById('logged-buttons').setAttribute('style', "display: block");
            document.getElementById('username-greeting').innerText = loginStatus.session.user_name;
            pageDisplayMethods.loadCourses();
        } else { // not logged
            document.getElementById('not-logged-buttons').setAttribute('style', "display: block");
        }
    });

