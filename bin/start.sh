echo 'running sail down and up...'
./vendor/bin/sail down
./vendor/bin/sail up -d

echo 'running queue...'
./vendor/bin/sail art queue:work
