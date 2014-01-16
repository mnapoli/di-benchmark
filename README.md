# DI containers benchmark

## Running the benchmarks

Install the dependencies using Composer:

```sh
$ composer install -o
```

Then, you can either boot a VM using Vagrant, or configure Apache.

1. Using vagrant: `vagrant up`
2. On your machine: `sudo ln -s web/ /var/www/di-benchmark`

If you use your machine, remember to disable xdebug.

Run the benchmarks:

```sh
$ ./run.sh
```
