@if ( count( $command['arguments'] ) || count( $command['options'] ) )
    <table class="table table-striped">
        <thead class="thead-inverse">
            <tr>
                <th> <b> Name </b> </th>
                <th> <b> Description </b> </th>
            </tr>
            </thead>
            <tbody>
                <tr> <td colspan="2" class="text-center"> <b> Arguments </b> </td> </tr>
                @forelse ($command['arguments'] as $argument)
                    <tr>
                        <td>{{ $argument->getName() }}</td>
                        <td>{{ $argument->getDescription() }}</td>
                    </tr>
                @empty
                    <tr> <td colspan="2" class="text-center"> <b> No Arguments Found </b> </td> </tr>
                @endforelse

                <tr> <td colspan="2" class="text-center"> <b> Options </b> </td> </tr>
                @forelse ($command['options'] as $option)
                    <tr>
                        <td>--{{ $option->getName() }}</td>
                        <td>{{ $option->getDescription() }}</td>
                    </tr>
                @empty
                    <tr> <td colspan="2" class="text-center"> <b> No Options Found </b> </td> </tr>
                @endforelse
            </tbody>
    </table>
@endif
