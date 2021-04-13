****1. Найти и указать в проекте Front Controller и расписать классы, которые с ним взаимодействуют.****

Насколько я понял, класс, являющийся front-контроллером это class Kernel.
Вероятно, в задании не имелись ввиду классы Symfony:
Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
Symfony\Component\DependencyInjection\ContainerBuilder;
Symfony\Component\Config\FileLocator;
Symfony\Component\HttpKernel\Controller\ControllerResolver;
Symfony\Component\HttpKernel\Controller\ArgumentResolver;
Symfony\Component\HttpFoundation\Request;
Symfony\Component\HttpFoundation\Response;
Symfony\Component\HttpFoundation\Session\Session;
Symfony\Component\Routing\Exception\ResourceNotFoundException;
Symfony\Component\Routing\Matcher\UrlMatcher;
Symfony\Component\Routing\RequestContext;
Symfony\Component\Routing\RouteCollection;

Непосредственно взаимодействует только с классом Registry

Косвенно через RouteCollection взаимодействует с контроллерами:
    MainController,
    ProductController,
    OrderController,
    UserController.
