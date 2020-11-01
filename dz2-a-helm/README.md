сам себе ссылки кое-какие

    https://helm.sh/docs/chart_template_guide/
    https://helm.sh/docs/chart_template_guide/builtin_objects/
    https://helm.sh/docs/chart_template_guide/debugging/

версии ПО:

    $ minikube start
    * minikube v1.14.0 on Ubuntu 20.04
    * Using the kvm2 driver based on existing profile
    * Starting control plane node minikube in cluster minikube
    * Restarting existing kvm2 VM for "minikube" ...
    * minikube 1.14.2 is available! Download it: https://github.com/kubernetes/minikube/releases/tag/v1.14.2
    * To disable this notice, run: 'minikube config set WantUpdateNotification false'

    * Preparing Kubernetes v1.19.2 on Docker 19.03.12 ...
    * Verifying Kubernetes components...
    * Verifying ingress addon...
    * Enabled addons: default-storageclass, storage-provisioner, ingress
    * kubectl not found. If you need it, try: 'minikube kubectl -- get pods -A'
    * Done! kubectl is now configured to use "minikube" by default


    $ helm version
    version.BuildInfo{Version:"v3.4.0", GitCommit:"7090a89efc8a18f3d8178bf47d2462450349a004", GitTreeState:"clean", GoVersion:"go1.14.10"}


    $ minikube kubectl -- get all
    $ helm list -a

далее поудаляли всё, что было, для чистоты

инсталлируем

    .../dz2-a-helm$ helm install sergei-baranov-dz2 ./dz2-chart --debug --dry-run


всё норм
теперь по-настоящему

    .../dz2-a-helm$ helm install sergei-baranov-dz2 ./dz2-chart
    NAME: sergei-baranov-dz2
    LAST DEPLOYED: Sun Nov  1 15:25:52 2020
    NAMESPACE: default
    STATUS: deployed
    REVISION: 1
    TEST SUITE: None

    $ helm list -a
    NAME                NAMESPACE  REVISION  UPDATED         STATUS    CHART            APP VERSION
    sergei-baranov-dz2  default    1         2020-11-01 ...  deployed  dz2-chart-0.1.0  0.1.0

    $ minikube kubectl -- get all
    NAME                              READY   STATUS    RESTARTS   AGE
    pod/sergei-baranov-dz2-rs-52wsj   1/1     Running   0          3m32s
    pod/sergei-baranov-dz2-rs-b75jm   1/1     Running   0          3m32s
    pod/sergei-baranov-dz2-rs-cphln   1/1     Running   0          3m32s

    NAME                                 TYPE        CLUSTER-IP      EXTERNAL-IP   PORT(S)          AGE
    service/kubernetes                   ClusterIP   10.96.0.1       <none>        443/TCP          10d
    service/sergei-baranov-dz2-service   NodePort    10.107.207.54   <none>        9000:31473/TCP   3m33s

    NAME                                    DESIRED   CURRENT   READY   AGE
    replicaset.apps/sergei-baranov-dz2-rs   3         3         3       3m33s

работа приложения:

    $ wget -qO- http://arch.homework/otusapp/sergei_baranov/health
    {"status": "OK"}

анинсталлим:

    $ helm uninstall sergei-baranov-dz2
    release "sergei-baranov-dz2" uninstalled

    $ minikube kubectl -- get all
    NAME                 TYPE        CLUSTER-IP   EXTERNAL-IP   PORT(S)   AGE
    service/kubernetes   ClusterIP   10.96.0.1    <none>        443/TCP   10d

    $ helm list -a
    NAME    NAMESPACE       REVISION        UPDATED STATUS  CHART   APP VERSION

ничего не осталось

По сути для запуска приложения достаточно

    .../dz2-a-helm$ helm install sergei-baranov-dz2 ./dz2-chart
    $ wget -qO- http://arch.homework/otusapp/sergei_baranov/health
    {"status": "OK"}