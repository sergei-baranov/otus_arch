сам себе ссылки кое-какие

    https://hub.docker.com/r/khromov/pico-php/dockerfile
    https://docs.docker.com/compose/environment-variables/
    https://www.php.net/manual/ru/features.commandline.webserver.php
    https://kubernetes.io/ru/docs/tasks/configure-pod-container/configure-liveness-readiness-startup-probes/
    https://kubernetes.io/ru/docs/tasks/tools/install-minikube/
    https://kubernetes.io/docs/tasks/access-application-cluster/ingress-minikube/

приложение в докере

    $ docker-compose build
    $ docker-compose up -d

    $ docker exec -it otus_arch_dz1 sh
    $ wget -qO- localhost:8000/ping
    $ wget -qO- localhost:8000/health
    $ wget -qO- localhost:8000/healthz
    $ wget -qO- localhost:8000/eee

    $ docker login -u viplokos -p ...
    $ docker tag dz1_otus_arch viplokos/dz1_otus_arch
    $ docker push viplokos/dz1_otus_arch

миникуб

    $ minikube status
    $ minikube start
    $ minikube status
    minikube
    type: Control Plane
    host: Running
    kubelet: Running
    apiserver: Running
    kubeconfig: Configured

    $ minikube kubectl -- apply -f .
    ... тут много документации и правок в скопипащенные конфиги ...

    $ minikube kubectl -- apply -f .
    deployment.apps/otus-arch-dz1-dep unchanged
    ingress.networking.k8s.io/otus-arch-dz1-ingress unchanged
    pod/otus-arch-dz1-app created
    replicaset.apps/otus-arch-dz1-rs created
    service/otus-arch-dz1-service unchanged

    $ minikube kubectl -- get deployments
    NAME                READY   UP-TO-DATE   AVAILABLE   AGE
    hello-minikube      1/1     1            1           92m
    otus-arch-dz1-dep   0/3     3            0           24m

    $ minikube kubectl -- get pods
    NAME                                 READY   STATUS             RESTARTS   AGE
    hello-minikube-5d9b964bfb-btbzz      1/1     Running            0          93m
    otus-arch-dz1-app                    0/1     CrashLoopBackOff   8          17m
    otus-arch-dz1-dep-86787b5bbb-kqwk7   0/1     CrashLoopBackOff   9          25m
    otus-arch-dz1-dep-86787b5bbb-kszh7   0/1     CrashLoopBackOff   9          25m
    otus-arch-dz1-dep-86787b5bbb-rvvf7   0/1     CrashLoopBackOff   9          25m
    otus-arch-dz1-rs-l7k7m               0/1     Completed          6          6m13s
    otus-arch-dz1-rs-tzrfh               0/1     CrashLoopBackOff   6          6m13s

    $ minikube kubectl -- delete -f .
    deployment.apps "otus-arch-dz1-dep" deleted
    ingress.networking.k8s.io "otus-arch-dz1-ingress" deleted
    replicaset.apps "otus-arch-dz1-rs" deleted
    service "otus-arch-dz1-service" deleted
    Error from server (NotFound): error when deleting "pod.yaml": pods "otus-arch-dz1-app" not found
    $ minikube kubectl -- get pods
    NAME                                 READY   STATUS        RESTARTS   AGE
    hello-minikube-5d9b964bfb-btbzz      1/1     Running       0          113m
    otus-arch-dz1-dep-86787b5bbb-8gjpd   0/1     Terminating   2          81s
    otus-arch-dz1-dep-86787b5bbb-rl6p6   0/1     Terminating   3          81s
    otus-arch-dz1-rs-ljvtg               0/1     Terminating   3          81s
    otus-arch-dz1-rs-v6fxb               0/1     Terminating   3          81s
    $ minikube kubectl -- get pods
    NAME                              READY   STATUS    RESTARTS   AGE
    hello-minikube-5d9b964bfb-btbzz   1/1     Running   0          113m

... переделал докера ...
(указал CMD в докерфайле)

    $ minikube kubectl -- apply -f .
    deployment.apps/otus-arch-dz1-dep created
    ingress.networking.k8s.io/otus-arch-dz1-ingress created
    pod/otus-arch-dz1-app created
    replicaset.apps/otus-arch-dz1-rs created
    service/otus-arch-dz1-service created

    $ minikube kubectl -- get pods
    NAME                                 READY   STATUS    RESTARTS   AGE
    hello-minikube-5d9b964bfb-btbzz      1/1     Running   0          133m
    otus-arch-dz1-app                    1/1     Running   0          73s
    otus-arch-dz1-dep-86787b5bbb-bqgdq   1/1     Running   0          73s
    otus-arch-dz1-dep-86787b5bbb-kn7jq   1/1     Running   0          73s
    otus-arch-dz1-dep-86787b5bbb-zvndg   1/1     Running   0          73s
    otus-arch-dz1-rs-fxwf8               1/1     Running   0          73s
    otus-arch-dz1-rs-zkdp9               1/1     Running   0          73s

    $ minikube kubectl -- get services
    NAME                    TYPE        CLUSTER-IP     EXTERNAL-IP   PORT(S)          AGE
    kubernetes              ClusterIP   10.96.0.1      <none>        443/TCP          3d8h
    otus-arch-dz1-service   NodePort    10.97.244.28   <none>        9000:30000/TCP   15m

    $ minikube profile list
    |----------|-----------|---------|----------------|------|---------|---------|
    | Profile  | VM Driver | Runtime |       IP       | Port | Version | Status  |
    |----------|-----------|---------|----------------|------|---------|---------|
    | minikube | kvm2      | docker  | 192.168.39.158 | 8443 | v1.19.2 | Running |
    |----------|-----------|---------|----------------|------|---------|---------|

    $ minikube kubectl -- get pod -n kube-system | grep ingress
    feynman@feynman-desktop:~/otus_arch/dz1$ minikube kubectl -- get pod -n kube-system
    NAME                               READY   STATUS    RESTARTS   AGE
    coredns-f9fd979d6-mz2q8            1/1     Running   1          3d14h
    etcd-minikube                      1/1     Running   1          3d14h
    kube-apiserver-minikube            1/1     Running   1          3d14h
    kube-controller-manager-minikube   1/1     Running   1          3d14h
    kube-proxy-tk927                   1/1     Running   1          3d14h
    kube-scheduler-minikube            1/1     Running   1          3d14h
    storage-provisioner                1/1     Running   2          3d14h

    $ minikube addons enable ingress
    * Verifying ingress addon...
    * The 'ingress' addon is enabled

    $ minikube service list
    |-------------|------------------------------------|--------------|-----------------------------|
    |  NAMESPACE  |                NAME                | TARGET PORT  |             URL             |
    |-------------|------------------------------------|--------------|-----------------------------|
    | default     | kubernetes                         | No node port |
    | default     | otus-arch-dz1-service              |         9000 | http://192.168.39.158:30054 |
    | kube-system | ingress-nginx-controller-admission | No node port |
    | kube-system | kube-dns                           | No node port |
    |-------------|------------------------------------|--------------|-----------------------------|

    $ minikube kubectl -- get service otus-arch-dz1-service
    NAME                    TYPE       CLUSTER-IP       EXTERNAL-IP   PORT(S)          AGE
    otus-arch-dz1-service   NodePort   10.101.110.234   <none>        9000:30054/TCP   31m

    $ minikube service otus-arch-dz1-service --url
    http://192.168.39.158:30054

    1$ minikube kubectl -- get ingress
    Warning: extensions/v1beta1 Ingress is deprecated in v1.14+, unavailable in v1.22+; use networking.k8s.io/v1 Ingress
    NAME                    CLASS    HOSTS           ADDRESS          PORTS   AGE
    otus-arch-dz1-ingress   <none>   arch.homework   192.168.39.158   80      20m

    $ wget -qO- 192.168.39.158:30054/otusapp/sergei_baranov/health
    <br />
    <b>Warning</b>:  Unknown: Failed to open stream: No such file or directory in <b>Unknown</b> on line <b>0</b><br />
    <br />
    <b>Fatal error</b>:  Failed opening required 'router.php' (include_path='.:') in <b>Unknown</b> on line <b>0</b><br />

    $ sudo nano /etc/hosts
    ... добавляю строку ...
    192.168.39.158  arch.homework

    $ wget -qO- http://arch.homework/otusapp/sergei_baranov/health
    <br />
    <b>Warning</b>:  Unknown: Failed to open stream: No such file or directory in <b>Unknown</b> on line <b>0</b><br />
    <br />
    <b>Fatal error</b>:  Failed opening required 'router.php' (include_path='.:') in <b>Unknown</b> on line <b>0</b><br />

ЙЕС!
теперь правим ошибку в контейнере, пересобираем, отправляем в докерхаб, удаляем и применяем конфиги кубера

    feynman@feynman-desktop:~/otus_arch/dz1$ cd ./dz1
    feynman@feynman-desktop:~/otus_arch/dz1/dz1$ docker ps -a
    feynman@feynman-desktop:~/otus_arch/dz1/dz1$ docker stop ...
    feynman@feynman-desktop:~/otus_arch/dz1/dz1$ docker rm ...
    feynman@feynman-desktop:~/otus_arch/dz1/dz1$ docker images
    feynman@feynman-desktop:~/otus_arch/dz1/dz1$ docker rmi viplokos/dz1_otus_arch
    feynman@feynman-desktop:~/otus_arch/dz1/dz1$ docker rmi dz1_otus_arch
    feynman@feynman-desktop:~/otus_arch/dz1/dz1$ docker-compose build
    feynman@feynman-desktop:~/otus_arch/dz1/dz1$ docker tag dz1_otus_arch viplokos/dz1_otus_arch
    feynman@feynman-desktop:~/otus_arch/dz1/dz1$ docker push viplokos/dz1_otus_arch
    feynman@feynman-desktop:~/otus_arch/dz1/dz1$ cd ..
    feynman@feynman-desktop:~/otus_arch/dz1$ minikube kubectl -- delete -f .
    deployment.apps "otus-arch-dz1-dep" deleted
    ingress.networking.k8s.io "otus-arch-dz1-ingress" deleted
    pod "otus-arch-dz1-app" deleted
    replicaset.apps "otus-arch-dz1-rs" deleted
    service "otus-arch-dz1-service" deleted
    feynman@feynman-desktop:~/otus_arch/dz1$ minikube kubectl -- apply -f .
    deployment.apps/otus-arch-dz1-dep created
    ingress.networking.k8s.io/otus-arch-dz1-ingress created
    pod/otus-arch-dz1-app created
    replicaset.apps/otus-arch-dz1-rs created
    service/otus-arch-dz1-service created

    $ wget -qO- http://arch.homework/otusapp/sergei_baranov/health
    {"status": "OK"}
    $ wget -qO- http://arch.homework/otusapp/sergei_baranov/ping
    pong
    $ wget -qO- http://arch.homework/otusapp/sergei_baranov/healthz
    {"status": "OK"}
    $ wget http://arch.homework/otusapp/sergei_baranov/eee
    --2020-10-25 13:21:18--  http://arch.homework/otusapp/sergei_baranov/eee
    Распознаётся arch.homework (arch.homework)… 192.168.39.158
    Подключение к arch.homework (arch.homework)|192.168.39.158|:80... соединение установлено.
    HTTP-запрос отправлен. Ожидание ответа… 404 Not Found
    2020-10-25 13:21:18 ОШИБКА 404: Not Found.

Ура! Работает!