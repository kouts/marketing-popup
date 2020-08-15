import { debounce } from '@/common/utils';

function getScrollPercent() {
  const h = document.documentElement;
  const b = document.body;
  const st = 'scrollTop';
  const sh = 'scrollHeight';
  return (h[st] || b[st]) / ((h[sh] || b[sh]) - h.clientHeight) * 100;
}

function createScrollPercent(options) {

  const defaults = {
    onTrigger: function() {},
    percent: 0
  };
  const opts = Object.assign({}, defaults, options);

  const scrollHandler = debounce(e => {
    const percent = getScrollPercent();
    if (opts.percent > 0 && percent >= opts.percent) {
      opts.onTrigger();
    }
  }, 250);

  const scrollPercent = {
    init() {
      window.addEventListener('scroll', scrollHandler);
    },
    destroy() {
      window.removeEventListener('scroll', scrollHandler);
    }
  };

  scrollPercent.init();

  return scrollPercent;
};

export { createScrollPercent };