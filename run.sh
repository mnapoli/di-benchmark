#!/bin/sh

BASE_URL="http://localhost/di-benchmark"
WARMUP=20
ITERATIONS=10000
CONCURRENT_REQ=10

rm -f web/cache/phpdi/*.php
rm -f web/cache/*.php

# Warmup
ab -n $WARMUP -c 1 ${BASE_URL}/phpdi.php > /dev/null
ab -n $WARMUP -c 1 ${BASE_URL}/phpdi-compiled.php > /dev/null
ab -n $WARMUP -c 1 ${BASE_URL}/symfony.php > /dev/null
ab -n $WARMUP -c 1 ${BASE_URL}/symfony-compiled.php > /dev/null
ab -n $WARMUP -c 1 ${BASE_URL}/aura.php > /dev/null

echo ""
echo "PHP-DI"
ab -q -n $ITERATIONS -c $CONCURRENT_REQ ${BASE_URL}/phpdi.php | grep "Time per request" | grep "(mean)"

echo ""
echo "PHP-DI compiled"
ab -q -n $ITERATIONS -c $CONCURRENT_REQ ${BASE_URL}/phpdi-compiled.php | grep "Time per request" | grep "(mean)"

echo ""
echo "Symfony"
ab -q -n $ITERATIONS -c $CONCURRENT_REQ ${BASE_URL}/symfony.php | grep "Time per request" | grep "(mean)"

echo ""
echo "Symfony compiled"
ab -q -n $ITERATIONS -c $CONCURRENT_REQ ${BASE_URL}/symfony-compiled.php | grep "Time per request" | grep "(mean)"

echo ""
echo "Aura"
ab -q -n $ITERATIONS -c $CONCURRENT_REQ ${BASE_URL}/aura.php | grep "Time per request" | grep "(mean)"
