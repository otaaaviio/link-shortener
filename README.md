# Link shortener

## Description
It's a simple **link shortener** that uses a hash function to generate a short link for a given URL and saves it in a PostgreSQL and Redis.

## Requirements

- [Docker](https://docs.docker.com/get-docker/)
- [Bash](https://www.gnu.org/software/bash/)

## Installation

1. Clone the repository
```bash
git clone https://github.com/otaaaviio/link-shortener.git
```

2. Enter the project directory
```bash
cd link-shortener
```

3. Run the installation script
```bash
./bin/setup.sh
```

## Usage

1. Start the application
```bash
./bin/start.sh
```

2. Now, you can send the following requests to the API:

 - POST -> `http://0.0.0.0:80/api/findOrCreate`:
```json
{
  "original_url": "https://www.example.com"
}
```

Will return:

```json
{
  "shortened_url": "http://0.0.0.0:80/api/{hashedUrl}"
}
```
  
 - GET -> `http://0.0.0.0:80/api/{hashedUrl}`


## Tests

To run the tests, you can use the following command:

```bash
./vendor/bin/sail test
```

ps: to run the tests, you need to have the application running.

## Collaboration

If you want to contribute to the project, you can fork the repository and create a pull request with your changes.

## Author

Otávio Gonçalves:
 - [GitHub](https://github.com/otaaaviio)
 - [Linkedin](https://www.linkedin.com/in/otaaaviio/)
