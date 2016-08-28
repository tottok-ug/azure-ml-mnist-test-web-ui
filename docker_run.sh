#!/bin/sh
which docker >/dev/null
test "$?" -ne 0 && echo "see: https://docs.docker.com/engine/installation/" && exit 1
cd $(dirname $0)
docker run -it --rm --name my-azure-ml-mnist-test-web-ui -p80:80 tottokug/mnist-test
