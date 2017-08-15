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