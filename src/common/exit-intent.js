import { isMobileDevice } from '@/common/is-mobile-device';

const isDesktop = !isMobileDevice();

function createExitIntent(options) {
  const defaults = {
    onTrigger: function() {}
  };
  const opts = Object.assign({}, defaults, options);

  let lastScrollTop = 0;
  let isScrolling = false;

  function trigger() {
    opts.onTrigger();
  }

  function mouseOutHandler(e) {
    // If the mouse is near the top of the window (50px) fire the exit intent
    // clientY: Vertical coordinate within the application's client area at which the event occurred (as opposed to the coordinate within the page).
    // relatedTarget: The EventTarget the pointing device entered (when out of the document === null)
    // Do NOT trigger when hovering or clicking on selects (Firefox bug)
    // console.log(e.clientY);
    // console.log(e.relatedTarget);
    if (e.clientY < 50 && e.relatedTarget === null && e.target.nodeName.toLowerCase() !== 'select') {
      // Remove this event listener
      // document.removeEventListener('mouseout', mouseOutHandler);

      // Fire the exit intent
      trigger();
    }
  };

  function beforeUnloadHandler(e) {
    trigger();
    e.preventDefault();
    // Chrome requires returnValue to be set.
    e.returnValue = '';
  }

  function scrollHandler(e) {
    var st = window.pageYOffset || document.documentElement.scrollTop; // Credits: "https://github.com/qeremy/so/blob/master/so.dom.js#L426"
    if (st > lastScrollTop) {
      // console.log('scrolled down');
    } else {
      console.log('scrolling up');
      window.clearTimeout(isScrolling);
      isScrolling = setTimeout(function() {
        // Run the callback
        console.log('Scrolling has stopped.');
      }, 66);
    }
    lastScrollTop = st <= 0 ? 0 : st; // For Mobile or negative scrolling
  }

  const exitIntent = {
    init() {
      window.addEventListener('beforeunload', beforeUnloadHandler);
      if (isDesktop) {
        document.addEventListener('mouseout', mouseOutHandler);
      }
      if (!isDesktop) {
        window.addEventListener('scroll', scrollHandler, false);
      }
    },
    destroy() {
      console.log('Destroyed');
      document.removeEventListener('mouseout', mouseOutHandler);
      window.removeEventListener('beforeunload', beforeUnloadHandler);
      window.removeEventListener('scroll', scrollHandler);
    },
    trigger() {
      trigger();
    }
  };

  return exitIntent;
};

export { createExitIntent };
