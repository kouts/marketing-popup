import { isMobileDevice } from '@/common/is-mobile-device';

const isDesktop = !isMobileDevice();

function createExitIntent(options) {
  const defaults = {
    onTrigger: function() {}
  };
  const opts = Object.assign({}, defaults, options);

  let doPreventUnload = false;
  let touchStartY;
  let touchEndY;

  const mouseOutHandler = (e) => {
    // clientY: Vertical coordinate within the application's client area at which the event occurred (as opposed to the coordinate within the page).
    // relatedTarget: The EventTarget the pointing device entered (when out of the document === null)
    // Do NOT trigger when hovering or clicking on selects (Firefox bug)
    if (e.clientY < 50 && e.relatedTarget === null && e.target.nodeName.toLowerCase() !== 'select') {
      opts.onTrigger();
    }
  };

  const beforeUnloadHandler = (e) => {
    opts.onTrigger();
    // console.log(doPreventUnload);
    if (doPreventUnload) {
      e.preventDefault();
      // Chrome requires returnValue to be set.
      e.returnValue = '';
    }
  };

  const touchStartHandler = (e) => {
    touchStartY = e.touches[0].clientY;
  };

  const touchEndHandler = (e) => {
    touchEndY = e.changedTouches[0].clientY;
    if (touchStartY > touchEndY) {
      // console.log('scrolled down');
    } else {
      // console.log('scrolled up');
      opts.onTrigger();
    }
  };

  const exitIntent = {
    preventUnload(boolVar) {
      doPreventUnload = boolVar;
    },
    init() {
      window.addEventListener('beforeunload', beforeUnloadHandler);
      if (isDesktop) {
        document.addEventListener('mouseout', mouseOutHandler);
      }
      if (!isDesktop) {
        window.addEventListener('touchstart', touchStartHandler);
        window.addEventListener('touchend', touchEndHandler);
      }
    },
    destroy() {
      window.removeEventListener('beforeunload', beforeUnloadHandler);
      if (isDesktop) {
        document.removeEventListener('mouseout', mouseOutHandler);
      }
      if (!isDesktop) {
        window.removeEventListener('scroll', touchStartHandler);
        window.removeEventListener('scroll', touchEndHandler);
      }
    }
  };

  exitIntent.init();

  return exitIntent;
};

export { createExitIntent };
