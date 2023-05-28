import './bootstrap';

Echo.channel(`testChannel`)
    .listen('TaskEvent', (e) => {
        console.log(e);
    });
