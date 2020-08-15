export const isMobileDevice = () => {
  if (/Mobi|Android/i.test(navigator.userAgent)) {
    return true;
  }
  return false;
};
