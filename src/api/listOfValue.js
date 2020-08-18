import { request } from '@/common/request';

export const fetchListOfValues = (listOfValues) => {
  const array = listOfValues.map(function(el, idx) {
    return 'listOfValues[' + idx + ']=' + el;
  }).join('&');

  return request({
    url: 'list-of-values/' + array
  });
};
