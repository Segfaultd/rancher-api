<?php
namespace Tyldar\Rancher\Resources;

use Tyldar\Rancher\Models\Stack;

class Stacks
{
    private $client;
    private $endpoint;

    public function __construct($client)
    {
        $this->client = $client;
        $this->endpoint = 'stacks';
    }

    private function format($stack, $tmp)
    {
        unset($stack->links);
        unset($stack->actions);

        $tmp->set($stack);

        unset($tmp->_readOnlyFields);

        return $tmp;
    }

    /**
     * @param array $criteria
     *
     * @return array
     */
    public function findBy($criteria)
    {
        $retn = [];

        $stacks = $this->client->request('GET', $this->endpoint.'/?'.http_build_query($criteria), [])->data;
        foreach($stacks as $key=>$stack)
        {
            if($stack->type != "stack")
                continue;

            array_push($retn, $this->format($stack, new Stack()));
        }
        return $retn;
    }

    /**
     * @param array $criteria
     *
     * @return Stack|null
     */
    public function findOneBy($criteria)
    {
        $stacks = $this->findBy($criteria);

        if (count($stacks) > 0) {
            return $this->format($stacks[0], new Stack());
        }

        return NULL;
    }

    public function getAll()
    {
        $retn = [];

        $stacks = $this->client->request('GET', $this->endpoint, [])->data;
        foreach($stacks as $key=>$stack)
        {
            if($stack->type != "stack")
                continue;

            array_push($retn, $this->format($stack, new Stack()));
        }
        return $retn;
    }

    public function get($id)
    {
        $stack = $this->client->request('GET', $this->endpoint.'/'.$id, []);
        return $this->format($stack, new Stack());
    }

    public function create(Stack $cont)
    {
        $stack = $this->client->request('POST', $this->endpoint, $cont->toArray());
        return $this->format($stack, new Stack());
    }

    public function remove($id)
    {
        $stack = $this->client->request('DELETE', $this->endpoint.'/'.$id, []);
        return $this->format($stack, new Stack());
    }
}
?>