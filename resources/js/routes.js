import Vue from 'vue'; //importo vue
import VueRouter from 'vue-router'; //importo vue-router

Vue.use(VueRouter);  //usa VueRouter

import Home from './pages/Home';
import About from './pages/About';
import Blog from './pages/Blog';
import Contact from './pages/Contact';
import PostDetail from './pages/PostDetail';
import Error404 from './pages/Error404';

const router = new VueRouter({      //creiamo la classe Router
    mode: 'history',                //tiene in memoria la navigazione nel browser
    linkExactActiveClass: 'active',
    routes:[
        {
            path: '/',              //caratteristica
            name: 'home',           //nome per richiamare la rotta
            component: Home         //andrà a puntare la HOME
        },
        {
            path: '/about',         //caratteristica
            name: 'about',          //nome per richiamare la rotta
            component: About        //andrà a puntare la HOME
        },        {
            path: '/blog',         //caratteristica
            name: 'blog',          //nome per richiamare la rotta
            component: Blog        //andrà a puntare la HOME
        },
        {
            path: '/contacts',         //caratteristica
            name: 'contacts',          //nome per richiamare la rotta
            component: Contact        //andrà a puntare la HOME
        },
        {
            path: '/post/:slug',         //caratteristica
            name: 'postDetail',          //nome per richiamare la rotta
            component: PostDetail        //andrà a puntare la HOME
        },
        {
            path: '/*',         //caratteristica
            name: 'error404',          //nome per richiamare la rotta
            component: Error404        //andrà a puntare la HOME
        }
    ]
});

export default router;              //esporto il router
