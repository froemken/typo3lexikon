/* convert br-tags to line-lines in Prism JS */
Prism.hooks.add('before-highlight', function(env) {
  env.element.innerHTML = env.element.innerHTML.replace(/<br\s*\/?>/g,'\n');
  env.code = env.element.textContent.replace(/^(?:\r?\n|\r)/,'');
});