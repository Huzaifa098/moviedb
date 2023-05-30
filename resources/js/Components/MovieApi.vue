<template>

    <div class="container mt-5 lux-container">
        <div class="row">
            <div class="col-12">
                <form class="form-inline lux-search-form">
                    <input
                        type="text"
                        class="form-control mb-2 mr-sm-2 lux-search-input"
                        id="search"
                        placeholder="Zoek naar een film..."
                        @input="debouncedSearchMovies"
                        v-model="search"
                    />

                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="lux-viewbox">
                    <div class="lux-view lux-view-list">
                        <i class="fa fa-bars" id="btn-listModel" aria-hidden="true"></i>
                    </div>
                    <div class="lux-view lux-view-grid">
                        <i class="fa fa-th" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row lux-movie-list">

            <div class="col-lg-6 col-md-6 col-sm-12" v-for="(movie, index) in movies" :key="index">
                <div class="card lux-movie-card">
                    <div class="row">
                        <div class="col-6">
                            <img :src="movie.backdrop_url" alt="Film poster"
                                 class="lux-movie-poster"/>

                        </div>
                        <div class="col-6">
                            <h1 class="lux-movie-list-title">{{ movie.original_title }}</h1>
                            <p class="lux-movie-description">{{ movie.overview }}</p>
                            <p class="lux-movie-info"><strong>Release date:</strong> {{ movie.releas_date_dutch }}</p>
                            <p class="lux-movie-info"><strong>Vote:</strong> {{ movie.vote_count }}</p>
                            <button class="btn lux-movie-button">Bekijken</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>


<script>
import axios from "axios";
import {debounce} from 'lodash';

export default {
    name: "movieApi",
    data() {
        return {
            search: "",
            movies: [],
        };
    },
    mounted() {
        this.debouncedSearchMovies = debounce(this.searchMovies, 300);
    },
    methods: {
        searchMovies() {


            // if (this.search === '') {
            //     return
            // }
            //
            // const apiUrl = `https://api.themoviedb.org/3/search/movie?api_key=deb99d16f653f7754f821559f9fcc667&query=${this.search}`;
            // // const apiKey = "deb99d16f653f7754f821559f9fcc667";
            // // const url = `${apiUrl}?api_key=${apiKey}&query=${this.Search}`;
            //
            // axios.get(apiUrl)
            //     .then(response => {
            //         this.movies = response.data.results.map((movie) => {
            //
            //             movie.releas_date_dutch = '1 januari 2022';
            //             movie.backdrop_url = `https://image.tmdb.org/t/p/original/${movie.backdrop_path}`
            //             return movie
            //         }).filter((movie) => {
            //             return movie.vote_count > 3
            //         })
            //         // Zorgen dat er in de movies array volledig pad naar image komt
            //         // Zorgen dat er in de movies array nederlandse datum terug komt van release_date
            //         // Zorgen dat alle films met een vote_count van lager dan 50 eruit gefilterd worden
            //     })
            //     .catch(error => {
            //         console.log(error);
            //     });

            axios
                .get("/api/movies", {
                    params: {
                        search: this.search,
                    },
                })
                .then((response) => {
                    this.movies = response.data;
                    console.log("movies", this.movies);
                })
                .catch((error) => {
                    console.log(error);
                });
        },


    }
};


</script>

<!--<script>-->
<!--import axios from "axios";-->
<!--import { debounce } from 'lodash';-->

<!--export default {-->
<!--    name: "movieApi",-->
<!--    data() {-->
<!--        return {-->
<!--            search: "",-->
<!--            movies: [],-->
<!--        };-->
<!--    },-->
<!--    mounted() {-->
<!--        this.debouncedSearchMovies = debounce(this.searchMovies, 300);-->
<!--    },-->
<!--    methods: {-->
<!--        searchMovies() {-->

<!--            axios-->
<!--                .get("/api/movies", {-->
<!--                    params: {-->
<!--                        search: this.search,-->
<!--                    },-->
<!--                })-->

<!--                .then((response) => {-->
<!--                    console.log(response.data)-->
<!--                    return this.movies = response.data.results.map((movie) => {-->

<!--                        movie.releas_date_dutch = '1 januari 2022';-->
<!--                        movie.backdrop_url = `https://image.tmdb.org/t/p/original/${movie.backdrop_path}`-->
<!--                        return movie-->
<!--                    }).filter((movie) => {-->
<!--                        return movie.vote_count > 3-->
<!--                    });-->
<!--                })-->
<!--                .catch((error) => {-->
<!--                    console.log(error);-->
<!--                });-->
<!--        },-->
<!--    },-->
<!--};-->
<!--</script>-->

<style scoped>
.lux-container {
    padding: 20px;
}


.lux-search-form {
    text-align: center;
}

.lux-search-input {
    width: 300px;
    border-radius: 20px;
    padding: 10px;
    font-size: 16px;
}

.lux-search-button {
    border-radius: 20px;
    padding: 10px 20px;
    font-size: 16px;
}

.lux-viewbox {
    float: right;
    margin-bottom: 20px;
}

.lux-view {
    display: inline-block;
    padding: 10px;
    font-size: 20px;
    color: #888;
    cursor: pointer;
}

.lux-view-list:hover,
.lux-view-grid:hover {
    color: #000;
}

.lux-movie-list-title {
    text-align: center;
    font-size: 24px;
    margin-bottom: 30px;
}

.lux-movie-card {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    border-radius: 10px;
    padding: 20px;
    text-align: center;
}

.lux-movie-poster {
    width: 100%;
    border-radius: 10px;
}

.lux-movie-title {
    margin-top: 10px;
    font-size: 20px;
    font-weight: bold;
}

.lux-movie-description {
    color: #888;
    font-size: 16px;
    margin-bottom: 10px;
}

.lux-movie-info {
    margin-bottom: 10px;
}

.lux-movie-button {
    border-radius: 20px;
    padding: 10px 20px;
    font-size: 16px;
    background-color: #000;
    color: #fff;
    border: none;
    cursor: pointer;
}

.lux-movie-button:hover {
    opacity: 0.8;
}
</style>
