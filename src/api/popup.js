import { request } from '@/common/request';

export const fetchPopups = (artist) => {
  return request({
    url: 'popups'
  });
};

export const fetchPopup = (id) => {
  return request({
    url: 'popups/' + id
  });
};
