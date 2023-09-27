# CRUD 테스트

## CREATE 게시판

```
{
  METHOD : POST
  url : http://localhost/api/boards/
  BODY : {"name":"게시판"}
}

-- 결과 값

{
    "name": "게시판",
    "updated_at": "2023-09-22T08:10:37.000000Z",
    "created_at": "2023-09-22T08:10:37.000000Z",
    "id": 1
}
```

## READ 게시판

-   전체 게시판 READ

```
{
  METHOD : GET
  url : http://localhost/api/boards/
}

-- 결과 값

{
    "id": 1,
    "name": "게시판",
    "created_at": "2023-09-22T08:10:37.000000Z",
    "updated_at": "2023-09-22T08:10:37.000000Z",
    "posts":[]
}
```

-   개별 게시판 READ

```
{
  METHOD : GET
  url : http://localhost/api/boards/1
}

-- 결과 값

{
    "id": 1,
    "name": "게시판",
    "created_at": "2023-09-22T08:10:37.000000Z",
    "updated_at": "2023-09-22T08:10:37.000000Z",
    "posts":[]
}
```

## UPDATE 게시판

```
{
  METHOD : PUT
  url : http://localhost/api/boards/1
  body : {"name":"수정"}
}

-- 결과 값

{
    "id": 1,
    "name": "수정",
    "created_at": "2023-09-22T08:10:37.000000Z",
    "updated_at": "2023-09-22T08:10:37.000000Z",
    "posts":[]
}
```

## DELETE 게시판

```
{
  METHOD : DELETE
  url : http://localhost/api/boards/1
}

-- 결과 값

{
    "deleted": true
}
```

## CREATE 포스트

```
{
  METHOD : POST
  url : http://localhost/api/boards/1/post
  BODY : {"name":"게시물", "detail":"내용"}
}

-- 결과 값

{
    "name": "게시물",
    "detail": "내용",
    "board_id": 1,
    "updated_at": "2023-09-22T08:21:48.000000Z",
    "created_at": "2023-09-22T08:21:48.000000Z",
    "id": 1
}
```

## READ 포스트

-   전체 포스트 READ

```
{
  METHOD : POST
  url : http://localhost/api/boards/1/post
}

-- 결과 값

{
    "id": 1,
    "board_id": 1,
    "name": "게시물",
    "detail": "내용",
    "created_at": "2023-09-22T08:21:48.000000Z",
    "updated_at": "2023-09-22T08:21:48.000000Z"
}
```

-   개별 포스트 READ

```
{
  METHOD : POST
  url : http://localhost/api/boards/1/post/1
}

-- 결과 값

{
    "id": 1,
    "board_id": 1,
    "name": "게시물",
    "detail": "내용",
    "created_at": "2023-09-22T08:21:48.000000Z",
    "updated_at": "2023-09-22T08:21:48.000000Z"
}
```

## UPDATE 포스트

```
{
  METHOD : POST
  url : http://localhost/api/boards/1/post/1
  body : {"name":"게시물수정", "detail":"내용수정"}
}

-- 결과 값

{
    "id": 1,
    "board_id": 1,
    "name": "게시물수정",
    "detail": "내용수정",
    "created_at": "2023-09-22T08:21:48.000000Z",
    "updated_at": "2023-09-22T08:21:48.000000Z"
}
```

## DELETE 포스트

```
{
  METHOD : DELETE
  url : http://localhost/api/boards/1/post/1
}

-- 결과 값

{
    "deleted": true
}

```
