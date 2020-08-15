import { isMobileDevice } from '@/common/is-mobile-device';

const isDesktop = !isMobileDevice();

function createExitIntent(options) {
  const defaults = {
    onTrigger: function() {}
  };
  const opts = Object.assign({}, defaults, options);

  let touchStartY;
  let touchEndY;

  const trigger = () => {
    opts.onTrigger();
  };

  const mouseOutHandler = (e) => {
    // clientY: Vertical coordinate within the application's client area at which the event occurred (as opposed to the coordinate within the page).
    // relatedTarget: The EventTarget the pointing device entered (when out of the document === null)
    // Do NOT trigger when hovering or clicking on selects (Firefox bug)
    if (e.clientY < 50 && e.relatedTarget === null && e.target.nodeName.toLowerCase() !== 'select') {
      trigger();
    }
  };

  const beforeUnloadHandler = (e) => {
    trigger();
    e.preventDefault();
    // Chrome requires returnValue to be set.
    e.returnValue = '';
  };

  const touchStartHandler = (e) => {
    touchStartY = e.touches[0].clientY;
  };

  const touchEndHandler = (e) => {
    touchEndY = e.changedTouches[0].clientY;
    if (touchStartY > touchEndY) {
      // console.log('down');
    } else {
      // console.log('up');
      trigger();
    }
  };

  const exitIntent = {
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
      // console.log('Destroyed');
      window.removeEventListener('beforeunload', beforeUnloadHandler);
      if (isDesktop) {
        document.removeEventListener('mouseout', mouseOutHandler);
      }
      if (!isDesktop) {
        window.removeEventListener('scroll', touchStartHandler);
        window.removeEventListener('scroll', touchEndHandler);
      }
    },
    trigger() {
      trigger();
    }
  };

  return exitIntent;
};

export { createExitIntent };
