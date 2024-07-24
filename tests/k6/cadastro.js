/* import http from 'k6/http';
import { sleep } from 'k6';

export default function () {
  http.get('https://test.k6.io');
  sleep(1);
} */


import http from 'k6/http';
import { check, sleep } from 'k6';

export const options = {
  stages: [
    { duration: '30s', target: 50 },
    { duration: '1m30s', target: 100 },
    { duration: '20s', target: 30 },
  ],
};

export default function () {

    const res = http.get('http://localhost:8080/');
    check(res, { 'status was 200': (r) => r.status == 201 });
    sleep(1);

}
