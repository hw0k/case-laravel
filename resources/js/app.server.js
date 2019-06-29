import App from './App';

import renderVueComponentToString from 'vue-server-renderer/basic';

renderVueComponentToString(App, (err, html) => {
  if (err) {
    throw new Error('Rendering error occured.');
  }
  dispatch(html);
});
