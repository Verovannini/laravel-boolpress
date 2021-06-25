const { default: Axios } = require("axios");

var app = new Vue(
    {
        el: '#root',
        data: {
            title: 'Lista dei post stampati tramite Vue Js',
            posts: []
        },
        mounted() {
            axios.get('http://127.0.0.1:8000/api/posts')
                .then(response => {
                    this.posts = response.data.posts;
                });
        }
    }
);