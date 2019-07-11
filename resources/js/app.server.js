/* global context, dispatch */

import renderVueComponentToString from 'vue-server-renderer/basic';
import app from './app';


app.$router.push(context.url);

renderVueComponentToString(app, (err, html) => {
    if (err) {
        throw new Error(err);
    }
    dispatch(html);
});
