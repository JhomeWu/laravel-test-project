
## About This Test
I want to know about the different between indexed or not.<br/>
So In this test, I create two types of users.<br/>
Only one of user table indexed it's column `register_at` which type is DateTime<br/>

## Step
1. Create two user tables
```bash
php artisan migrate
```
2. Add fake user to table
For Example: Add 10000 users
```bash
php artisan fake:user 10000
```  
It will create user evenly beween now and 30 years ago
3. You can test as many time as you want
For Example: test get {36} months range of {10} user {1000} times
```bash
php artisan fake:search --month=36 --limit=10  --times=1000
```

## Test Result
- Fake Users Number: 190,000
- LIMIT 10

| Month | Index speed up(%) |
| :----:| :----: |
| 12 | -1.5 ~ 1.5 |
| 9 | 1.9 ~ 3.8 |
| 6 | 14 ~ 17 |
| 3 | 40 ~ 50 |

