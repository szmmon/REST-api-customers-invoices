
# Invoice-customer REST api laravel

Api made for working with customer-invoice data, tested with postman. Front-end done with inertia.js and tailwind css. 

[API use case](doc:linking-to-pages#API)

[GIF demo](doc:linking-to-pages#Presentation)
## API 

#### Get all customers


```http
  GET /api/{{VERSION}}/customers
```
![App Screenshot](https://github.com/szmmon/api/blob/main/images/get-customers.png)

#### Get all customers with invoices

```http
  GET /api/{{VERSION}}/customers?includeInvoices=true
```
![App Screenshot](https://github.com/szmmon/api/blob/main/images/get-customers-invoices.png)

#### Get customer

```http
  GET /api/{{VERSION}}/customers/{id}
```
![App Screenshot](https://github.com/szmmon/api/blob/main/images/get-customer.png)


| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `int`    | Id of customer to fetch |



#### Edit customer
```http
  PUT/PATCH /api/{{VERSION}}/customers/{id}
```
![App Screenshot](https://github.com/szmmon/api/blob/main/images/patch-customer.png)

#### Filter customers
```http
  GET/api/{{VERSION}}/customers?{parameter}[{comparison}]={value}
```

Example: Get customers where "type" is equal to "I"
![App Screenshot](https://github.com/szmmon/api/blob/main/images/customers-filter-type.png)

Available comparison operators:
| Operator | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `[eq]`      | `int/string`    | **equal** |
| `[ne]`      | `int/string`    | **not equal** |
| `[lt]`      | `int`    | **less than** |
| `[lte]`      | `int`    | **less than or equal** |
| `[gt]`      | `int`    | **greater than** |
| `[gte]`      | `int`    | **greater than or equal** |

#### Get all invoices

```http
  GET /api/{{VERSION}}/invoices
```
![App Screenshot](https://github.com/szmmon/api/blob/main/images/get-invoices.png)

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `int`    | Id of invoice to fetch |

#### Get invoice

```http
  GET /api/{{VERSION}}/invoices/{id}
```
![App Screenshot](https://github.com/szmmon/api/blob/main/images/get-invoice.png)

#### Edit invoice
```http
  PUT/PATCH /api/{{VERSION}}/invoices/{id}
```
![App Screenshot](https://github.com/szmmon/api/blob/main/images/invoice-edit-img.png)

#### Add invoice
```http
  POST /api/{{VERSION}}/invoices
```
![App Screenshot](https://github.com/szmmon/api/blob/main/images/post-invoices.png)

#### Bulk add invoices
```http
  POST /api/{{VERSION}}/invoices/bulk
```
![App Screenshot](https://github.com/szmmon/api/blob/main/images/post-invoices-bulk.png)

#### Filter invoices
```http
  GET/api/{{VERSION}}/invoices?{parameter}[{comparison}]={value}
```

Example: Get invoices where "amount" is greater than or equal to 3000
![App Screenshot](https://github.com/szmmon/api/blob/main/images/invoice-filter.png)

Available comparison operators:
| Operator | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `[eq]`      | `int/string`    | **equal** |
| `[ne]`      | `int/string`    | **not equal** |
| `[lt]`      | `int`    | **less than** |
| `[lte]`      | `int`    | **less than or equal** |
| `[gt]`      | `int`    | **greater than** |
| `[gte]`      | `int`    | **greater than or equal** |


## Selected features

- Seeder for customers and invoices

- Bulk adding invoices

- Filtering for equality, greater than etc. 

- Including invoices for customer in one endpoint




## Presentation

- Customers viewing and filtering, data coming from api. 
![App Screenshot](https://github.com/szmmon/api/blob/main/images/customers-filter.gif)

- Creating new invoice, done with POST request to api.
![App Screenshot](https://github.com/szmmon/api/blob/main/images/invoice-create.gif)

- Editing invoices, done with PUT and PATCH requests. 
![App Screenshot](https://github.com/szmmon/api/blob/main/images/invoice-edit.gif)

- Generating pdf invoices, done with library laravel-invoices
![App Screenshot](https://github.com/szmmon/api/blob/main/images/invoice-pdf.gif)


